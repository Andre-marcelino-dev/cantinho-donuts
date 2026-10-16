<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Fornecedor;


class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::withCount('materiasPrimas')
            ->orderByRaw("status_fornecedor = 'ATIVO' DESC")
            ->orderBy('nome_fornecedor')
            ->get();

        return view('admin.fornecedor.index', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate($this->regras(), $this->mensagens());
        Fornecedor::create($this->limpar($dados));

        return redirect()->route('admin.fornecedor')->with('sucesso', 'Fornecedor cadastrado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $dados = $request->validate($this->regras($fornecedor->id_fornecedor), $this->mensagens());
        $fornecedor->update($this->limpar($dados));

        return redirect()->route('admin.fornecedor')->with('sucesso', 'Fornecedor atualizado com sucesso!');
    }

    // Fornecedor não é excluído (as matérias-primas apontam para ele): só ativa/desativa
    public function alterarStatus($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->status_fornecedor = $fornecedor->status_fornecedor === 'ATIVO' ? 'INATIVO' : 'ATIVO';
        $fornecedor->save();

        return redirect()->back()->with('sucesso', 'Status atualizado!');
    }

    private function regras($idIgnorado = null): array
    {
        return [
            'nome_fornecedor'          => 'required|string|max:50',
            'representante_fornecedor' => 'required|string|max:50',
            'email_fornecedor'         => ['required', 'email', 'max:80', Rule::unique('tbl_fornecedores', 'email_fornecedor')->ignore($idIgnorado, 'id_fornecedor')],
            'telefone_fornecedor'      => 'required|string|max:20',
            'status_fornecedor'        => 'required|in:ATIVO,INATIVO',
        ];
    }

    private function mensagens(): array
    {
        return [
            'nome_fornecedor.required'          => 'Informe o nome do fornecedor.',
            'representante_fornecedor.required' => 'Informe o nome do representante.',
            'email_fornecedor.required'         => 'Informe o e-mail do fornecedor.',
            'email_fornecedor.email'            => 'Informe um e-mail válido.',
            'email_fornecedor.unique'           => 'Já existe um fornecedor com esse e-mail.',
            'telefone_fornecedor.required'      => 'Informe o telefone do fornecedor.',
        ];
    }

    // Telefone guardado só com números (a coluna aceita 14 caracteres)
    private function limpar(array $dados): array
    {
        $dados['telefone_fornecedor'] = substr(preg_replace('/\D/', '', $dados['telefone_fornecedor']), 0, 14);
        $dados['nome_fornecedor'] = trim($dados['nome_fornecedor']);
        $dados['representante_fornecedor'] = trim($dados['representante_fornecedor']);
        return $dados;
    }
}
