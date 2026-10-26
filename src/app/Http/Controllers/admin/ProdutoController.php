<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Importante para limpar os vínculos do Kit

class ProdutoController extends Controller
{
    public function index()
    {
         $produtos = Produto::orderBy('ordem_produto')->get();
         
        $filtroCategoria = Categoria::where('status_categoria', 'ATIVO')
            ->orderBy('ordem_categoria')
            ->get();

        // 🌟 Listando tudo no painel administrativo (Ativos e Inativos)
        $listaProduto = Produto::with('CategoriaProduto')
            ->orderBy('ordem_produto')
            ->get();

        $categoriaAtiva = 'all';

        $categorias = Categoria::where('status_categoria', 'ATIVO')
            ->orderBy('nome_categoria')
            ->get();

        return view('admin.produto.index', compact(
            'filtroCategoria',
            'listaProduto',
            'categoriaAtiva',
            'categorias'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_produto'        => 'required|string|max:255',
            'slug_produto'        => 'required|string|max:255',
            'descricao_produto'   => 'required|string',
            'tamanho_produto'     => 'required|string',
            'unid_medida_produto' => 'required|string',
            'valor_produto'       => 'required|numeric',
            'status_produto'      => 'required|string',
            'destaque_produto'    => 'required|string',
            'id_categoria'        => 'required|integer',
            'ordem_produto'       => 'required|integer',
            'foto_produto'        => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $caminhoFoto = null;
        if ($request->hasFile('foto_produto')) {
            $arquivo = $request->file('foto_produto');
            $nomeFoto = $request->slug_produto . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('donuts/images/produto'), $nomeFoto);
            $caminhoFoto = 'produto/' . $nomeFoto;
        }

        try {
            Produto::create([
                'nome_produto'        => $request->nome_produto,
                'slug_produto'        => $request->slug_produto,
                'descricao_produto'   => $request->descricao_produto,
                'tamanho_produto'     => $request->tamanho_produto,
                'unid_medida_produto' => $request->unid_medida_produto,
                'valor_produto'       => $request->valor_produto,
                'status_produto'      => $request->status_produto,
                'destaque_produto'    => $request->destaque_produto,
                'id_categoria'        => $request->id_categoria,
                'ordem_produto'       => $request->ordem_produto,
                'foto_produto'        => $caminhoFoto,
            ]);
            return redirect()->back()->with('sucesso', 'Produto cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', 'Erro ao cadastrar produto. Tente novamente.');
        }
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $produto->nome_produto = $request->nome_produto;
        $produto->slug_produto = $request->slug_produto;
        $produto->descricao_produto = $request->descricao_produto;
        $produto->tamanho_produto = $request->tamanho_produto;
        $produto->unid_medida_produto = $request->unid_medida_produto;
        $produto->valor_produto = $request->valor_produto;
        $produto->status_produto = $request->status_produto;
        $produto->destaque_produto = $request->destaque_produto;
        $produto->id_categoria = $request->id_categoria;
        $produto->ordem_produto = $request->ordem_produto;

        if ($request->hasFile('foto_produto')) {
            $nomeFoto = time() . '.' . $request->foto_produto->extension();
            $request->foto_produto->move(
                public_path('donuts/images'),
                $nomeFoto
            );
            $produto->foto_produto = $nomeFoto;
        }

        $produto->save();

        return redirect()
            ->back()
            ->with('sucesso', 'Produto updated com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        try {
            // 1. Remove o vínculo desse produto na tabela de itens de kit primeiro
            DB::table('tbl_itens_kit')->where('id_produto', $id)->delete();

            // 2. Tenta remover a foto física do servidor
            if ($produto->foto_produto && file_exists(public_path('donuts/images/' . $produto->foto_produto))) {
                unlink(public_path('donuts/images/' . $produto->foto_produto));
            }

            // 3. Deleta o produto de fato
            $produto->delete();

            return redirect()->back()->with('sucesso', 'Produto excluído com sucesso!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('erro', 'Não foi possível excluir o produto devido a um erro inesperado.');
        }
    }

    public function alterarStatus($id)
    {
        $produto = Produto::findOrFail($id);

        $produto->status_produto = ($produto->status_produto === 'ATIVO') ? 'INATIVO' : 'ATIVO';
        $produto->save();

        return redirect()->back()->with('sucesso', 'Status do produto atualizado com sucesso!');
    }
}
