<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ZonaEntrega;
use App\Services\AreaEntrega;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    // GET /api/v1/entrega/zonas
    // Zonas de entrega ativas com os bairros (para mostrar no app)
    public function zonas()
    {
        return response()->json([
            'success' => true,
            'data' => ZonaEntrega::ativas()->map(fn ($zona) => $this->zona($zona) + [
                'bairros' => $zona->bairros->pluck('nome_bairro_entrega')->values(),
            ]),
        ]);
    }

    // GET /api/v1/entrega/consultar?cep=08161540
    // Diz se entregamos no CEP e qual é a taxa
    public function consultar(Request $request)
    {
        $consulta = AreaEntrega::consultar((string) $request->query('cep', ''));

        return response()->json([
            'success' => true,
            'data' => [
                'entregamos'   => $consulta['status'] === 'ok',
                'status'       => $consulta['status'], // ok | fora | indefinido | cep_invalido
                'cep'          => $consulta['cep'],
                'bairro'       => $consulta['bairro'],
                'cidade'       => $consulta['cidade'],
                'uf'           => $consulta['uf'],
                'distancia_km' => $consulta['distancia_km'],
                'zona'         => $consulta['zona'] ? $this->zona($consulta['zona']) : null,
            ],
        ]);
    }

    // GET /api/v1/entrega/minha
    // Taxa que o pedido com entrega vai cobrar, pelo endereço principal do cliente logado
    public function minha(Request $request)
    {
        $entrega = AreaEntrega::paraCliente($request->user()->id_cliente);

        return response()->json([
            'success' => true,
            'data' => [
                'entregamos'   => $entrega['status'] !== 'fora',
                'status'       => $entrega['status'], // ok | fora | padrao
                'taxa_entrega' => round($entrega['taxa'], 2),
                'previsao'     => $entrega['prazo'],
                'id_endereco'  => $entrega['endereco']?->id_endereco,
                'zona'         => $entrega['zona'] ? $this->zona($entrega['zona']) : null,
            ],
        ]);
    }

    private function zona(ZonaEntrega $zona): array
    {
        return [
            'id'     => $zona->id_zona_entrega,
            'nome'   => $zona->nome_zona_entrega,
            'taxa'   => round($zona->taxa_zona_entrega, 2),
            'prazo'  => $zona->prazo_zona_entrega,
            'km_min' => $zona->km_min_zona_entrega,
            'km_max' => $zona->km_max_zona_entrega,
        ];
    }
}
