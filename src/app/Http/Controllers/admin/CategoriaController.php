<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Categoria;


class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy("ordem_categoria")->get();
        return view('admin.categoria.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_categoria'      => 'required|string|max:30',
            'descricao_categoria' => 'required|string',
            'ordem_categoria'     => 'required|integer',
            'status_categoria'    => 'required|in:ATIVO,INATIVO',
        ]);

        Categoria::create([
            'nome_categoria'      => $request->nome_categoria,
            'descricao_categoria' => $request->descricao_categoria,
            'ordem_categoria'     => $request->ordem_categoria,
            'status_categoria'    => $request->status_categoria,
        ]);

        return redirect()->route('admin.categoria')
                         ->with('sucesso', 'Categoria criada com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_categoria'      => 'required|string|max:30',
            'descricao_categoria' => 'required|string',
            'ordem_categoria'     => 'required|integer',
            'status_categoria'    => 'required|in:ATIVO,INATIVO',
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->nome_categoria      = $request->nome_categoria;
        $categoria->descricao_categoria = $request->descricao_categoria;
        $categoria->ordem_categoria     = $request->ordem_categoria;
        $categoria->status_categoria    = $request->status_categoria;

        $categoria->save();

        return redirect()->route('admin.categoria')
                         ->with('sucesso', 'Categoria atualizada com sucesso!');
    }

    public function alterarStatus($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->status_categoria = $categoria->status_categoria === 'ATIVO' ? 'INATIVO' : 'ATIVO';
        $categoria->save();

        return redirect()->back()->with('sucesso', 'Status atualizado!');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        try {
            $categoria->delete();
        } catch (QueryException $e) {
            return redirect()->route('admin.categoria')
                             ->with('erro', 'Não foi possível excluir: existem produtos ligados a esta categoria.');
        }

        return redirect()->route('admin.categoria')
                         ->with('sucesso', 'Categoria excluída com sucesso!');
    }
}
