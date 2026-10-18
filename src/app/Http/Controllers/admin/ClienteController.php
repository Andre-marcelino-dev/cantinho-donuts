<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $listaCliente = Cliente::orderBy('nome_cliente')->get();
        return view('admin.cliente.index', compact('listaCliente'));
    }

   public function store(Request $request)
{
    $request->validate([
        'nome_cliente'        => 'required|string|max:50',
        'tipo_cliente'        => 'required|in:PF,PJ',
        'cpf_cnpj_cliente'    => 'required|string|max:18',
        'data_nasc_cliente'   => 'nullable|date',
        'endereco_cliente'    => 'nullable|string|max:40',
        'numero_cliente'      => 'nullable|string|max:6',
        'complemento_cliente' => 'nullable|string|max:50',
        'bairro_cliente'      => 'nullable|string|max:40',
        'cidade_cliente'      => 'nullable|string|max:40',
        'uf_cliente'          => 'nullable|string|max:2',
        'cep_cliente'         => 'nullable|string|max:9',
        'email_cliente'       => 'nullable|email|max:80',
        'telefone_cliente'    => 'nullable|string|max:14',
        'foto_cliente'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'senha_cliente'       => 'required|string|min:6|confirmed', // ← adicione
    ]);

    try {
        $dados = $request->all();

        // Criptografa a senha
        if ($request->filled('senha_cliente')) {
            $dados['senha_cliente'] = bcrypt($request->senha_cliente);
        }

        if ($request->hasFile('foto_cliente') && $request->file('foto_cliente')->isValid()) {
            $nomeArquivo = time() . '_' . $request->file('foto_cliente')->getClientOriginalName();
            $request->file('foto_cliente')->move(public_path('davilla/images/cliente'), $nomeArquivo);
            $dados['foto_cliente'] = $nomeArquivo;
        }

        Cliente::create($dados);

        return redirect()->route('admin.cliente')->with('sucesso', 'Cliente cadastrado com sucesso!');
    } catch (\Exception $e) {
        return redirect()->route('admin.cliente')->with('erro', 'Erro ao cadastrar cliente: ' . $e->getMessage());
    }
}

   public function update(Request $request, $id)
{
    $request->validate([
        'nome_cliente'        => 'required|string|max:50',
        'tipo_cliente'        => 'required|in:PF,PJ',
        'cpf_cnpj_cliente'    => 'required|string|max:18',
        'data_nasc_cliente'   => 'nullable|date',
        'endereco_cliente'    => 'nullable|string|max:40',
        'numero_cliente'      => 'nullable|string|max:6',
        'complemento_cliente' => 'nullable|string|max:50',
        'bairro_cliente'      => 'nullable|string|max:40',
        'cidade_cliente'      => 'nullable|string|max:40',
        'uf_cliente'          => 'nullable|string|max:2',
        'cep_cliente'         => 'nullable|string|max:9',
        'email_cliente'       => 'nullable|email|max:80',
        'telefone_cliente'    => 'required|string|max:14',
        'foto_cliente'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'senha_cliente'       => 'nullable|string|min:6', // ← adicione
    ]);

    try {
        $cliente = Cliente::findOrFail($id);

        if ($request->hasFile('foto_cliente') && $request->file('foto_cliente')->isValid()) {
            $nomeArquivo = time() . '_' . $request->file('foto_cliente')->getClientOriginalName();
            $request->file('foto_cliente')->move(public_path('davilla/images/cliente'), $nomeArquivo);
            $cliente->foto_cliente = $nomeArquivo;
        }

        $cliente->nome_cliente        = $request->nome_cliente;
        $cliente->tipo_cliente        = $request->tipo_cliente;
        $cliente->cpf_cnpj_cliente    = $request->cpf_cnpj_cliente;
        $cliente->data_nasc_cliente   = $request->data_nasc_cliente;
        $cliente->endereco_cliente    = $request->endereco_cliente;
        $cliente->numero_cliente      = $request->numero_cliente;
        $cliente->complemento_cliente = $request->complemento_cliente;
        $cliente->bairro_cliente      = $request->bairro_cliente;
        $cliente->cidade_cliente      = $request->cidade_cliente;
        $cliente->uf_cliente          = $request->uf_cliente;
        $cliente->cep_cliente         = $request->cep_cliente;
        $cliente->email_cliente       = $request->email_cliente;
        $cliente->telefone_cliente    = $request->telefone_cliente;

        // Só atualiza a senha se uma nova foi informada
        if ($request->filled('senha_cliente')) {
            $cliente->senha_cliente = bcrypt($request->senha_cliente);
        }

        $cliente->save();

        return redirect()->route('admin.cliente')->with('sucesso', 'Cliente atualizado com sucesso!');
    } catch (\Exception $e) {
        return redirect()->route('admin.cliente')->with('erro', 'Erro ao atualizar: ' . $e->getMessage());
    }
}

    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $nome = $cliente->nome_cliente;

            $cliente->delete();

            return redirect()->route('admin.cliente')
                ->with('sucesso', "O cadastro de '{$nome}' foi removido com sucesso do sistema.");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.cliente')
                ->with('erro', 'Não é possível excluir este cliente pois ele possui pedidos ou históricos vinculados ao sistema.');
        } catch (\Exception $e) {
            return redirect()->route('admin.cliente')
                ->with('erro', 'Desculpe, ocorreu um problema interno ao tentar processar a exclusão. Tente novamente.');
        }
    }

    public function status($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);

            $cliente->status_cliente = ($cliente->status_cliente === 'ATIVO') ? 'INATIVO' : 'ATIVO';

            $cliente->save();

            return redirect()->route('admin.cliente')
                ->with('sucesso', "Status do cliente '{$cliente->nome_cliente}' atualizado com sucesso!");
        } catch (\Exception $e) {
            return redirect()->route('admin.cliente')
                ->with('erro', 'Erro ao alterar o status do cliente: ' . $e->getMessage());
        }
    }
}
