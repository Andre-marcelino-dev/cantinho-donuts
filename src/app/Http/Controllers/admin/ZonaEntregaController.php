<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ZonaEntrega;
use App\Services\AreaEntrega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ZonaEntregaController extends Controller
{
    public function index(Request $request)
    {
        $zonas = ZonaEntrega::with('bairros')
            ->orderByRaw("status_zona_entrega = 'ATIVO' DESC")
            ->orderBy('km_min_zona_entrega')
            ->get();

        // "Testar um CEP": mostra em qual zona ele cai, do mesmo jeito que o site e o app calculam
        $cepTeste = preg_replace('/\D/', '', (string) $request->query('cep'));
        $teste = strlen($cepTeste) === 8 ? AreaEntrega::consultar($cepTeste) : null;

        $lojaCoordenadas = AreaEntrega::coordenadasLoja();

        return view('admin.zona-entrega.index', compact('zonas', 'cepTeste', 'teste', 'lojaCoordenadas'));
    }

    public function store(Request $request)
    {
        [$dados, $bairros] = $this->validar($request);

        DB::transaction(function () use ($dados, $bairros) {
            $zona = ZonaEntrega::create($dados);
            $zona->bairros()->createMany($bairros);
        });

        return redirect()->route('admin.zona-entrega')->with('sucesso', "{$dados['nome_zona_entrega']} criada com sucesso!");
    }

    public function update(Request $request, $id)
    {
        $zona = ZonaEntrega::findOrFail($id);
        [$dados, $bairros] = $this->validar($request);

        DB::transaction(function () use ($zona, $dados, $bairros) {
            $zona->update($dados);
            $zona->bairros()->delete();
            $zona->bairros()->createMany($bairros);
        });

        return redirect()->route('admin.zona-entrega')->with('sucesso', "{$dados['nome_zona_entrega']} atualizada com sucesso!");
    }

    public function alterarStatus($id)
    {
        $zona = ZonaEntrega::findOrFail($id);
        $zona->status_zona_entrega = $zona->status_zona_entrega === 'ATIVO' ? 'INATIVO' : 'ATIVO';
        $zona->save();

        return redirect()->back()->with('sucesso', 'Status atualizado!');
    }

    public function destroy($id)
    {
        $zona = ZonaEntrega::findOrFail($id);
        $nome = $zona->nome_zona_entrega;
        $zona->delete(); // os bairros saem junto (cascade)

        return redirect()->route('admin.zona-entrega')->with('sucesso', "{$nome} excluída.");
    }

    // Valida a zona e transforma o campo "Bairros" (um por linha) em registros
    private function validar(Request $request): array
    {
        // Aceita vírgula como separador decimal (ex.: 2,5 km / R$ 8,50)
        foreach (['km_min_zona_entrega', 'km_max_zona_entrega', 'taxa_zona_entrega'] as $campo) {
            $request->merge([$campo => str_replace(',', '.', (string) $request->input($campo))]);
        }

        $dados = $request->validate([
            'nome_zona_entrega'    => 'required|string|max:30',
            'apelido_zona_entrega' => 'nullable|string|max:40',
            'km_min_zona_entrega'  => 'required|numeric|min:0|max:999',
            'km_max_zona_entrega'  => 'required|numeric|gt:km_min_zona_entrega|max:999',
            'taxa_zona_entrega'    => 'required|numeric|min:0|max:999',
            'prazo_zona_entrega'   => 'required|string|max:30',
            'cor_zona_entrega'     => 'required|in:' . implode(',', array_keys(ZonaEntrega::CORES)),
            'status_zona_entrega'  => 'required|in:ATIVO,INATIVO',
            'bairros'              => 'nullable|string|max:5000',
        ], [
            'nome_zona_entrega.required'  => 'Informe o nome da zona (ex.: Zona 1).',
            'km_max_zona_entrega.gt'      => 'O km máximo precisa ser maior que o km mínimo.',
            'km_min_zona_entrega.numeric' => 'O km mínimo precisa ser um número, ex.: 3 ou 2,5.',
            'km_max_zona_entrega.numeric' => 'O km máximo precisa ser um número, ex.: 6 ou 5,5.',
            'taxa_zona_entrega.numeric'   => 'A taxa precisa ser um número, ex.: 8,50 (use 0 para grátis).',
            'prazo_zona_entrega.required' => 'Informe o prazo, ex.: 40 a 60 min.',
        ]);

        $bairros = [];
        $linhas = preg_split('/\r\n|\r|\n/', (string) ($dados['bairros'] ?? ''));
        foreach ($linhas as $numero => $linha) {
            if (trim($linha) === '') continue;

            [$nome, $faixa] = array_pad(explode('|', $linha, 2), 2, '');
            $nome = trim($nome);
            preg_match_all('/\d{5}-?\d{3}/', $faixa, $ceps);
            $ceps = array_map(fn ($c) => str_replace('-', '', $c), $ceps[0]);

            $erro = match (true) {
                $nome === ''                            => 'está sem o nome do bairro',
                mb_strlen($nome) > 60                   => 'tem um nome com mais de 60 caracteres',
                trim($faixa) !== '' && !$ceps           => 'tem uma faixa de CEP inválida (use 08160-000 a 08169-999)',
                isset($ceps[1]) && $ceps[1] < $ceps[0]  => 'tem o CEP final menor que o inicial',
                default                                 => null,
            };
            if ($erro) {
                throw ValidationException::withMessages(['bairros' => 'A linha ' . ($numero + 1) . " dos bairros $erro."]);
            }

            $bairros[] = [
                'nome_bairro_entrega'       => $nome,
                'cep_inicio_bairro_entrega' => $ceps[0] ?? null,
                'cep_fim_bairro_entrega'    => $ceps[1] ?? ($ceps[0] ?? null),
            ];
        }
        unset($dados['bairros']);

        return [$dados, $bairros];
    }
}
