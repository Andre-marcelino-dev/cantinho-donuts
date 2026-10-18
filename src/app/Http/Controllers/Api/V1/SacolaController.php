<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Sacola;
use Illuminate\Http\Request;

class SacolaController extends Controller
{
    // GET /api/v1/sacola
    // Lista os itens da sacola do cliente logado (pelo token)
    public function index(Request $request)
    {
        $itens = Sacola::with('produto')
            ->where('id_cliente', $request->user()->id_cliente)
            ->whereHas('produto', function ($query) {
                $query->where('status_produto', 'ATIVO');
            })
            ->orderBy('criado_em_sacola')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $itens,
        ]);
    }

    // POST /api/v1/sacola
    // Adiciona um produto; se já estiver na sacola, soma a quantidade
    public function store(Request $request)
    {
        $dados = $request->validate([
            'id_produto' => 'required|integer',
            'quantidade' => 'sometimes|integer|min:1',
        ]);

        $produto = Produto::where('id_produto', $dados['id_produto'])
            ->where('status_produto', 'ATIVO')
            ->firstOrFail();

        $item = Sacola::firstOrNew([
            'id_cliente' => $request->user()->id_cliente,
            'id_produto' => $produto->id_produto,
        ]);
        $item->qtde_sacola = ($item->exists ? $item->qtde_sacola : 0) + ($dados['quantidade'] ?? 1);
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Produto adicionado à sacola.',
            'data' => $item->load('produto'),
        ], 201);
    }

    // PUT e PATCH /api/v1/sacola/{id}
    // Troca a quantidade de um item
    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'quantidade' => 'required|integer|min:1',
        ]);

        $item = Sacola::where('id_sacola', $id)
            ->where('id_cliente', $request->user()->id_cliente)
            ->firstOrFail();

        $item->qtde_sacola = $dados['quantidade'];
        $item->save();

        return response()->json([
            'success' => true,
            'data' => $item->load('produto'),
        ]);
    }

    // DELETE /api/v1/sacola/{id}
    public function destroy(Request $request, int $id)
    {
        Sacola::where('id_sacola', $id)
            ->where('id_cliente', $request->user()->id_cliente)
            ->firstOrFail()
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removido da sacola.',
        ]);
    }
}
