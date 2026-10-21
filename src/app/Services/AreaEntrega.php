<?php

namespace App\Services;

use App\Models\Configuracao;
use App\Models\EnderecoCliente;
use App\Models\ZonaEntrega;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/*
 | Descobre em qual zona de entrega um CEP cai, nesta ordem:
 |  1. faixa de CEP cadastrada em algum bairro (exata, definida no painel)
 |  2. nome do bairro que os Correios devolvem, igual a um bairro cadastrado
 |  3. distância em linha reta até a loja, comparada com o km de cada zona
 |
 | Usado pela página Região do site e pela API do app (taxa do pedido).
 */
class AreaEntrega
{
    // Respostas de consulta guardadas em cache (CEP e coordenadas quase nunca mudam)
    const CACHE_DIAS = 30;

    /**
     * @return array{status: string, cep: string, logradouro: ?string, bairro: ?string, cidade: ?string, uf: ?string,
     *               zona: ?ZonaEntrega, distancia_km: ?float, metodo: ?string}
     *
     * status: ok (entregamos) | fora (não entregamos) | indefinido (não deu para calcular) | cep_invalido
     */
    public static function consultar(string $cep, ?string $logradouro = null): array
    {
        $cep = preg_replace('/\D/', '', $cep);
        $resposta = [
            'status' => 'indefinido', 'cep' => self::formatarCep($cep),
            'logradouro' => null, 'bairro' => null, 'cidade' => null, 'uf' => null,
            'zona' => null, 'distancia_km' => null, 'metodo' => null,
        ];

        if (strlen($cep) !== 8) {
            return ['status' => 'cep_invalido'] + $resposta;
        }

        $endereco = self::buscarCep($cep);
        if ($endereco === false) {
            return ['status' => 'cep_invalido'] + $resposta;
        }
        if ($endereco) {
            $resposta = array_merge($resposta, [
                'logradouro' => $logradouro ?: ($endereco['logradouro'] ?? null),
                'bairro'     => $endereco['bairro'] ?? null,
                'cidade'     => $endereco['localidade'] ?? null,
                'uf'         => $endereco['uf'] ?? null,
            ]);
        }

        $zonas = ZonaEntrega::ativas();

        // 1. Faixa de CEP
        foreach ($zonas as $zona) {
            foreach ($zona->bairros as $bairro) {
                $inicio = $bairro->cep_inicio_bairro_entrega;
                if ($inicio && $cep >= $inicio && $cep <= ($bairro->cep_fim_bairro_entrega ?: $inicio)) {
                    return array_merge($resposta, ['status' => 'ok', 'zona' => $zona, 'metodo' => 'cep']);
                }
            }
        }

        // 2. Nome do bairro
        if ($resposta['bairro']) {
            $nome = self::normalizar($resposta['bairro']);
            foreach ($zonas as $zona) {
                foreach ($zona->bairros as $bairro) {
                    if (self::normalizar($bairro->nome_bairro_entrega) === $nome) {
                        return array_merge($resposta, ['status' => 'ok', 'zona' => $zona, 'metodo' => 'bairro']);
                    }
                }
            }
        }

        // 3. Distância até a loja
        $origem = self::coordenadasLoja();
        $destino = self::coordenadas($cep, $resposta);
        if (!$origem || !$destino) {
            return $resposta; // indefinido
        }

        $km = round(self::distanciaKm($origem, $destino), 1);
        $zona = $zonas->first(fn ($z) => $km >= $z->km_min_zona_entrega && $km <= $z->km_max_zona_entrega);

        // Achou só o centro do bairro (não a rua): pode ser outro bairro com o mesmo nome
        // em outra parte da cidade, então não afirma que está fora da área
        if (!$zona && ($destino[2] ?? '') === 'bairro') {
            return $resposta; // indefinido (a distância não é confiável, então não mostra)
        }

        return array_merge($resposta, [
            'status'       => $zona ? 'ok' : 'fora',
            'zona'         => $zona,
            'distancia_km' => $km,
            'metodo'       => 'distancia',
        ]);
    }

    /**
     * Taxa de entrega de um cliente, pelo endereço principal dele (o mesmo que o pedido usa).
     * Sem endereço ou sem conseguir localizar o CEP, vale a taxa padrão das Configurações da loja.
     *
     * @return array{status: string, taxa: float, prazo: string, zona: ?ZonaEntrega, endereco: ?EnderecoCliente, consulta: ?array}
     *
     * status: ok | fora (não entregamos nesse endereço) | padrao (usou a taxa padrão)
     */
    public static function paraCliente(int $idCliente): array
    {
        $endereco = EnderecoCliente::where('id_cliente', $idCliente)
            ->where('status_endereco', 'ATIVO')
            ->where('principal_endereco', 'SIM')
            ->first();

        $padrao = [
            'status' => 'padrao', 'taxa' => Configuracao::taxaEntrega(), 'prazo' => Configuracao::previsaoEntrega(),
            'zona' => null, 'endereco' => $endereco, 'consulta' => null,
        ];

        if (!$endereco || ZonaEntrega::where('status_zona_entrega', 'ATIVO')->doesntExist()) {
            return $padrao;
        }

        $consulta = self::consultar($endereco->cep, $endereco->endereco);

        return match ($consulta['status']) {
            'ok'    => array_merge($padrao, [
                'status' => 'ok', 'taxa' => $consulta['zona']->taxa_zona_entrega,
                'prazo' => $consulta['zona']->prazo_zona_entrega, 'zona' => $consulta['zona'], 'consulta' => $consulta,
            ]),
            'fora'  => array_merge($padrao, ['status' => 'fora', 'consulta' => $consulta]),
            default => array_merge($padrao, ['consulta' => $consulta]),
        };
    }

    // Coordenadas da loja: as do painel ou, se estiverem vazias, as do endereço em config/services.php
    public static function coordenadasLoja(): ?array
    {
        $lat = Configuracao::valor('loja_latitude');
        $lng = Configuracao::valor('loja_longitude');
        if ($lat !== '' && $lng !== '') {
            return [(float) $lat, (float) $lng];
        }

        $loja = config('services.loja');
        $cep = preg_replace('/\D/', '', $loja['cep'] ?? '');
        if (strlen($cep) !== 8) return null;

        // Usa o nome da rua dos Correios (o do config pode ter outra grafia)
        $endereco = self::buscarCep($cep) ?: [];
        $coordenadas = self::coordenadas($cep, [
            'logradouro' => $endereco['logradouro'] ?? ($loja['endereco'] ?? null),
            'bairro'     => $endereco['bairro'] ?? null,
            'cidade'     => $endereco['localidade'] ?? null,
            'uf'         => $endereco['uf'] ?? null,
        ]);

        // Guarda para não precisar consultar de novo (e para aparecer no painel)
        if ($coordenadas) {
            Configuracao::definir('loja_latitude', (string) $coordenadas[0]);
            Configuracao::definir('loja_longitude', (string) $coordenadas[1]);
        }

        return $coordenadas;
    }

    // Distância em linha reta entre dois pontos [lat, lng] (fórmula de Haversine)
    public static function distanciaKm(array $a, array $b): float
    {
        $raioTerra = 6371;
        $dLat = deg2rad($b[0] - $a[0]);
        $dLng = deg2rad($b[1] - $a[1]);
        $h = sin($dLat / 2) ** 2 + cos(deg2rad($a[0])) * cos(deg2rad($b[0])) * sin($dLng / 2) ** 2;

        return 2 * $raioTerra * asin(min(1, sqrt($h)));
    }

    public static function formatarCep(string $cep): string
    {
        return strlen($cep) === 8 ? substr($cep, 0, 5) . '-' . substr($cep, 5) : $cep;
    }

    // ViaCEP: array com o endereço, false se o CEP não existe, null se o serviço não respondeu
    private static function buscarCep(string $cep): array|false|null
    {
        $chave = "area_entrega:cep:$cep";
        if (Cache::has($chave)) return Cache::get($chave);

        try {
            $dados = Http::timeout(5)->get("https://viacep.com.br/ws/$cep/json/")->throw()->json();
        } catch (\Throwable $e) {
            return null; // não guarda: tenta de novo na próxima consulta
        }

        $resultado = !empty($dados['erro']) ? false : $dados;
        Cache::put($chave, $resultado, now()->addDays(self::CACHE_DIAS));

        return $resultado;
    }

    // [lat, lng] do endereço pelo OpenStreetMap (Nominatim).
    // Obs.: a BrasilAPI devolve o centro da cidade para quase todo CEP de SP, por isso não é usada.
    private static function coordenadas(string $cep, array $endereco): ?array
    {
        $chave = "area_entrega:coord:$cep:" . md5((string) ($endereco['logradouro'] ?? ''));
        if (Cache::has($chave)) return Cache::get($chave) ?: null;

        $coordenadas = self::coordenadasNominatim($endereco + ['cep' => $cep]);
        if ($coordenadas === false) return null; // serviço não respondeu: tenta de novo na próxima

        // Se não achou o endereço no mapa, guarda por 1 dia só, para tentar de novo depois
        Cache::put($chave, $coordenadas ?? false, $coordenadas ? now()->addDays(self::CACHE_DIAS) : now()->addDay());

        return $coordenadas;
    }

    // [lat, lng, 'rua'|'bairro'] se achou, null se o endereço não está no mapa, false se o serviço não respondeu
    private static function coordenadasNominatim(array $endereco): array|false|null
    {
        if (empty($endereco['cidade'])) return null;

        $cidade = [$endereco['cidade'], $endereco['uf'] ?? null, 'Brasil'];
        $rua = $endereco['logradouro'] ?? null;
        // "Colônia (Zona Leste)" → "Colônia": o complemento só existe nos Correios
        $bairro = trim(preg_replace('/\(.*?\)/', '', (string) ($endereco['bairro'] ?? ''))) ?: null;

        // Começo do CEP (ex.: 0814 → região do Itaim Paulista). Usado para aceitar a busca só
        // pela rua: em SP há várias ruas com o mesmo nome, mas não com o mesmo começo de CEP.
        $cep = preg_replace('/\D/', '', (string) ($endereco['cep'] ?? ''));
        $prefixoCep = strlen($cep) === 8 ? substr($cep, 0, 4) : null;

        // Da mais precisa para a menos: rua + bairro, só a rua (o bairro dos Correios às vezes
        // tem outro nome no mapa: Jardim Benfica = Santa Margarida Paulista) e o centro do bairro.
        // [busca, nome que o resultado precisa conter, precisão, começo de CEP exigido]
        // O nome é conferido porque o mapa "chuta" lugares parecidos
        // (ex.: Parque Paulistano → Clube Paulistano, no Jardins).
        $tentativas = array_filter([
            $rua && $bairro ? [implode(', ', array_filter([$rua, $bairro, ...$cidade])), $rua, 'rua', null] : null,
            $rua && $prefixoCep ? [implode(', ', array_filter([$rua, ...$cidade])), $rua, 'rua', $prefixoCep] : null,
            $bairro ? [implode(', ', array_filter([$bairro, ...$cidade])), $bairro, 'bairro', null] : null,
        ]);

        foreach (array_values($tentativas) as $i => [$busca, $esperado, $precisao, $exigeCep]) {
            // O Nominatim aceita no máximo 1 consulta por segundo
            if ($i > 0) usleep(1_100_000);

            try {
                // O Nominatim exige identificar quem está consultando
                $dados = Http::timeout(6)
                    ->withHeaders(['User-Agent' => 'ConfeitariaDavilla/1.0 (' . config('services.loja.email') . ')'])
                    ->get('https://nominatim.openstreetmap.org/search', [
                        'q' => $busca, 'format' => 'json', 'limit' => 5, 'countrycodes' => 'br',
                    ])->throw()->json();
            } catch (\Throwable $e) {
                return false; // serviço fora do ar: não guarda em cache
            }

            $esperado = self::normalizar($esperado);
            $cidadeNorm = self::normalizar($endereco['cidade']);
            foreach ((array) $dados as $lugar) {
                $nome = self::normalizar($lugar['display_name'] ?? '');
                $cepOk = !$exigeCep || preg_match('/\b' . $exigeCep . '\d-?\d{3}\b/', $lugar['display_name'] ?? '');
                if ($cepOk && str_contains($nome, $esperado) && str_contains($nome, $cidadeNorm) && isset($lugar['lat'], $lugar['lon'])) {
                    return [(float) $lugar['lat'], (float) $lugar['lon'], $precisao];
                }
            }
        }

        return null;
    }

    private static function normalizar(?string $texto): string
    {
        // Sem acento, minúsculo e sem o que estiver entre parênteses ("Colônia (Zona Leste)" = "colonia")
        return Str::of(preg_replace('/\(.*?\)/', ' ', (string) $texto))->ascii()->lower()->squish()->toString();
    }
}
