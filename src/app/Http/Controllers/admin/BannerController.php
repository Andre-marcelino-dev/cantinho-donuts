<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;


class BannerController extends Controller
{
    // Mesma pasta que o site (slider da Home) e a API do app usam
    const PASTA = 'donuts/images/banner';

    public function index()
    {
        $banners = Banner::orderByRaw("status_banner = 'ATIVO' DESC")
            ->orderBy('ordem_banner')
            ->orderBy('id_banner')
            ->get();

        return view('admin.banner.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_banner'   => 'required|string|max:30',
            'ordem_banner'  => 'required|integer|min:0',
            'status_banner' => 'required|in:ATIVO,INATIVO',
            'foto_banner'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], $this->mensagens());

        $dados['foto_banner'] = $this->salvarImagem($request);
        // titulo_banner não aceita vazio no banco; o slider não mostra o título
        $dados['titulo_banner'] = $dados['nome_banner'];

        Banner::create($dados);

        return redirect()->route('admin.banner')->with('sucesso', 'Banner criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $dados = $request->validate([
            'nome_banner'   => 'required|string|max:30',
            'ordem_banner'  => 'required|integer|min:0',
            'status_banner' => 'required|in:ATIVO,INATIVO',
            'foto_banner'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], $this->mensagens());

        // A imagem só muda se uma nova foi enviada
        if ($request->hasFile('foto_banner')) {
            $fotoAntiga = $banner->foto_banner;
            $dados['foto_banner'] = $this->salvarImagem($request);
            $this->apagarImagemSeNaoUsada($fotoAntiga, $banner->id_banner);
        } else {
            unset($dados['foto_banner']);
        }
        $dados['titulo_banner'] = $dados['nome_banner'];

        $banner->update($dados);

        return redirect()->route('admin.banner')->with('sucesso', 'Banner atualizado com sucesso!');
    }

    public function alterarStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status_banner = $banner->status_banner === 'ATIVO' ? 'INATIVO' : 'ATIVO';
        $banner->save();

        return redirect()->back()->with('sucesso', 'Status atualizado!');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $foto = $banner->foto_banner;
        $banner->delete();
        $this->apagarImagemSeNaoUsada($foto, $id);

        return redirect()->route('admin.banner')->with('sucesso', 'Banner excluído.');
    }

    private function salvarImagem(Request $request): string
    {
        $arquivo = $request->file('foto_banner');
        // Nome curto e sem espaços (a coluna aceita até 50 caracteres)
        $nome = time() . '_banner.' . $arquivo->extension();
        $arquivo->move(public_path(self::PASTA), $nome);

        return $nome;
    }

    // Só apaga o arquivo se nenhum outro banner usar a mesma imagem
    private function apagarImagemSeNaoUsada(?string $foto, $idIgnorado): void
    {
        if (!$foto) return;

        $emUso = Banner::where('foto_banner', $foto)->where('id_banner', '!=', $idIgnorado)->exists();
        $caminho = public_path(self::PASTA . '/' . basename($foto));

        if (!$emUso && is_file($caminho)) {
            @unlink($caminho);
        }
    }

    private function mensagens(): array
    {
        return [
            'nome_banner.required'  => 'Informe o nome do banner.',
            'foto_banner.required'  => 'Escolha a imagem do banner.',
            'foto_banner.image'     => 'O arquivo precisa ser uma imagem.',
            'foto_banner.mimes'     => 'Use uma imagem JPG, PNG ou WEBP.',
            'foto_banner.max'       => 'A imagem pode ter no máximo 2 MB.',
            'foto_banner.uploaded'  => 'Não foi possível enviar a imagem (talvez seja grande demais).',
        ];
    }
}
