<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EnderecoCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnderecoController extends Controller
{
    // Mesmos limites das colunas de tbl_enderecos_cliente
    const REGRAS = [
        'nome_endereco' => 'required|string|max:30',
        'endereco'      => 'required|string|max:40',
        'numero'        => 'required|string|max:6',
        'complemento'   => 'nullable|string|max:50',
        'bairro'        => 'required|string|max:40',
        'cidade'        => 'required|string|max:40',
        'uf'            => 'required|string|size:2',
        'cep'           => 'required|string|max:9',
    ];

    // Endereços ativos do cliente logado (o principal primeiro)
    private function enderecosDoCliente(Request $request)
    {
        return EnderecoCliente::where('id_cliente', $request->user()->id_cliente)
            ->where('status_endereco', 'ATIVO');
    }

    // GET /api/v1/enderecos
    public function index(Request $request)
    {
        $enderecos = $this->enderecosDoCliente($request)
            ->orderByRaw("principal_endereco = 'SIM' DESC")
            ->orderBy('id_endereco')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $enderecos,
        ]);
    }

    // GET /api/v1/enderecos/{id}
    public function show(Request $request, int $id)
    {
        return response()->json([
            'success' => true,
            'data' => $this->enderecosDoCliente($request)->where('id_endereco', $id)->firstOrFail(),
        ]);
    }

    // POST /api/v1/enderecos
    // O primeiro endereço do cliente já vira o principal
    public function store(Request $request)
    {
        $dados = $request->validate(self::REGRAS);
        $dados['uf'] = strtoupper($dados['uf']);
        $dados['id_cliente'] = $request->user()->id_cliente;
        $dados['principal_endereco'] = $this->enderecosDoCliente($request)->exists() ? 'NAO' : 'SIM';

        $endereco = EnderecoCliente::create($dados);

        return response()->json([
            'success' => true,
            'message' => 'Endereço adicionado com sucesso.',
            'data' => $endereco->fresh(),
        ], 201);
    }

    // PUT e PATCH /api/v1/enderecos/{id}
    public function update(Request $request, int $id)
    {
        $endereco = $this->enderecosDoCliente($request)->where('id_endereco', $id)->firstOrFail();

        $dados = $request->validate(self::REGRAS);
        $dados['uf'] = strtoupper($dados['uf']);
        $endereco->update($dados);

        return response()->json([
            'success' => true,
            'message' => 'Endereço atualizado com sucesso.',
            'data' => $endereco->fresh(),
        ]);
    }

    // PATCH /api/v1/enderecos/{id}/principal
    // Marca este endereço como o usado nas entregas
    public function principal(Request $request, int $id)
    {
        $endereco = $this->enderecosDoCliente($request)->where('id_endereco', $id)->firstOrFail();

        DB::transaction(function () use ($request, $endereco) {
            $this->enderecosDoCliente($request)->update(['principal_endereco' => 'NAO']);
            $endereco->update(['principal_endereco' => 'SIM']);
        });

        return response()->json([
            'success' => true,
            'message' => 'Endereço de entrega atualizado.',
            'data' => $endereco->fresh(),
        ]);
    }

    // DELETE /api/v1/enderecos/{id}
    // Só desativa, porque pedidos antigos podem apontar para este endereço
    public function destroy(Request $request, int $id)
    {
        $endereco = $this->enderecosDoCliente($request)->where('id_endereco', $id)->firstOrFail();

        DB::transaction(function () use ($request, $endereco) {
            $eraPrincipal = $endereco->principal_endereco === 'SIM';
            $endereco->update(['status_endereco' => 'INATIVO', 'principal_endereco' => 'NAO']);

            // Se apagou o principal, o próximo endereço ativo passa a ser o principal
            if ($eraPrincipal) {
                $this->enderecosDoCliente($request)->orderBy('id_endereco')->first()
                    ?->update(['principal_endereco' => 'SIM']);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Endereço excluído.',
        ]);
    }
}
