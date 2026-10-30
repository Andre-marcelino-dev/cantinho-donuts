<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Categoria;


class CategoriaController extends Controller
{
    // Imagens dos cards de categoria da Home (enviadas pelo painel)
    const PASTA = 'davilla/images/categoria';

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
            'foto_categoria'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], $this->mensagens());

        Categoria::create([
            'nome_categoria'      => $request->nome_categoria,
            'descricao_categoria' => $request->descricao_categoria,
            'foto_categoria'      => $request->hasFile('foto_categoria') ? $this->salvarImagem($request) : null,
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
            'foto_categoria'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], $this->mensagens());

        $categoria = Categoria::findOrFail($id);

        $categoria->nome_categoria      = $request->nome_categoria;
        $categoria->descricao_categoria = $request->descricao_categoria;
        $categoria->ordem_categoria     = $request->ordem_categoria;
        $categoria->status_categoria    = $request->status_categoria;

        // A imagem só muda se uma nova foi enviada
        if ($request->hasFile('foto_categoria')) {
            $this->apagarImagem($categoria->foto_categoria);
            $categoria->foto_categoria = $this->salvarImagem($request);
        }

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
        $foto = $categoria->foto_categoria;

        try {
            $categoria->delete();
        } catch (QueryException $e) {
            return redirect()->route('admin.categoria')
                             ->with('erro', 'Não foi possível excluir: existem produtos ligados a esta categoria.');
        }

        $this->apagarImagem($foto);

        return redirect()->route('admin.categoria')
                         ->with('sucesso', 'Categoria excluída com sucesso!');
    }

    private function salvarImagem(Request $request): string
    {
        $arquivo = $request->file('foto_categoria');
        // Nome curto e sem espaços (a coluna aceita até 60 caracteres)
        $nome = time() . '_categoria.' . $arquivo->extension();
        $arquivo->move(public_path(self::PASTA), $nome);

        return $nome;
    }

    private function apagarImagem(?string $foto): void
    {
        if (!$foto) return;

        $caminho = public_path(self::PASTA . '/' . basename($foto));
        if (is_file($caminho)) {
            @unlink($caminho);
        }
    }

    private function mensagens(): array
    {
        return [
            'foto_categoria.image'    => 'O arquivo precisa ser uma imagem.',
            'foto_categoria.mimes'    => 'Use uma imagem JPG, PNG ou WEBP.',
            'foto_categoria.max'      => 'A imagem pode ter no máximo 2 MB.',
            'foto_categoria.uploaded' => 'Não foi possível enviar a imagem (talvez seja grande demais).',
        ];
    }
}
