<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cupom;
use App\Models\EnderecoCliente;
use App\Models\Sacola;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    // Mesmo valor mostrado no app
    const TAXA_ENTREGA = 6.0;

    const FORMAS_PAGAMENTO = [
        'pix'      => 'Pix',
        'cartao'   => 'Cartão',
        'dinheiro' => 'Dinheiro',
    ];

    // GET /api/v1/pedidos
    // Lista os pedidos do cliente logado, do mais novo para o mais antigo
    public function index(Request $request)
    {
        $pedidos = Venda::with(['itens.produto', 'cupom'])
            ->where('id_cliente', $request->user()->id_cliente)
            ->orderByDesc('data_venda')
            ->orderByDesc('id_venda')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pedidos,
        ]);
    }

    // POST /api/v1/pedidos
    // Transforma a sacola do cliente logado em um pedido e esvazia a sacola.
    // Os preços vêm do banco, não do app.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'entrega'         => 'required|boolean',
            'forma_pagamento' => 'required|in:pix,cartao,dinheiro',
            'observacao'      => 'nullable|string|max:500',
            'cupom'           => 'nullable|string|max:20',
        ]);

        $cliente = $request->user();

        $itensSacola = Sacola::with('produto')
            ->where('id_cliente', $cliente->id_cliente)
            ->whereHas('produto', function ($query) {
                $query->where('status_produto', 'ATIVO');
            })
            ->get();

        if ($itensSacola->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Sua sacola está vazia.',
            ], 422);
        }

        $subtotal = $itensSacola->sum(fn ($item) => $item->produto->valor_produto * $item->qtde_sacola);
        $taxaEntrega = $dados['entrega'] ? self::TAXA_ENTREGA : 0;

        // Cupom: porcentagem de desconto sobre os produtos (não sobre a entrega)
        $cupom = null;
        if (!empty($dados['cupom'])) {
            $cupom = Cupom::validoHoje($dados['cupom']);
            if (!$cupom) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cupom inválido ou expirado. Remova o cupom ou use outro.',
                ], 422);
            }
        }
        $desconto = $cupom ? $cupom->descontoSobre($subtotal) : 0;

        // Na entrega, usa o endereço principal do cliente (se ele tiver cadastrado algum)
        $idEndereco = $dados['entrega']
            ? EnderecoCliente::where('id_cliente', $cliente->id_cliente)
                ->where('status_endereco', 'ATIVO')
                ->where('principal_endereco', 'SIM')
                ->value('id_endereco')
            : null;

        $pedido = DB::transaction(function () use ($cliente, $dados, $itensSacola, $subtotal, $taxaEntrega, $idEndereco, $cupom, $desconto) {
            $pedido = Venda::create([
                'id_cliente'            => $cliente->id_cliente,
                'id_endereco'           => $idEndereco,
                'id_cupom'              => $cupom?->id_cupom,
                // Horário de Brasília (o Laravel está em UTC)
                'data_venda'            => now('America/Sao_Paulo')->format('Y-m-d H:i:s'),
                'valor_venda'           => round($subtotal + $taxaEntrega - $desconto, 2),
                'status_venda'          => 'EM ANDAMENTO',
                'forma_pagamento_venda' => self::FORMAS_PAGAMENTO[$dados['forma_pagamento']],
                'entrega_venda'         => $dados['entrega'] ? 'SIM' : 'NAO',
                'observacao_venda'      => $dados['observacao'] ?? null,
                'valor_desconto_venda'  => $desconto,
            ]);

            foreach ($itensSacola as $item) {
                $pedido->itens()->create([
                    'id_produto'      => $item->id_produto,
                    'valor_unit_item' => $item->produto->valor_produto,
                    'qtde_item'       => $item->qtde_sacola,
                ]);
            }

            Sacola::where('id_cliente', $cliente->id_cliente)->delete();

            return $pedido;
        });

        return response()->json([
            'success' => true,
            'message' => 'Pedido realizado com sucesso.',
            'data' => $pedido->fresh(['itens.produto', 'cupom']),
        ], 201);
    }

    // GET /api/v1/pedidos/{id}
    // Só encontra o pedido se ele for do cliente logado
    public function show(Request $request, int $id)
    {
        $pedido = Venda::with(['itens.produto', 'cupom'])
            ->where('id_venda', $id)
            ->where('id_cliente', $request->user()->id_cliente)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $pedido,
        ]);
    }
}
