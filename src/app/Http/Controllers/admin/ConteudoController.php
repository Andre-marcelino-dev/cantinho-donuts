<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Conteudo;


// Textos e imagens das páginas do site (config/conteudo.php + tbl_conteudos)
class ConteudoController extends Controller
{
    public function index()
    {
        $paginas = config('conteudo');
        $alterados = Conteudo::alterados();

        // Quantos campos cada página tem e quantos já foram alterados
        $resumo = [];
        foreach ($paginas as $slug => $pagina) {
            $chaves = $this->chavesDaPagina($pagina);
            $resumo[$slug] = [
                'campos'    => count($chaves),
                'alterados' => count(array_intersect($chaves, array_keys($alterados))),
                'imagens'   => count(array_filter($chaves, fn ($c) => Conteudo::campos()[$c]['tipo'] === 'imagem')),
            ];
        }

        return view('admin.conteudo.index', compact('paginas', 'resumo'));
    }

    public function edit(string $pagina)
    {
        $config = config("conteudo.$pagina") ?? abort(404);
        $alterados = Conteudo::alterados();

        return view('admin.conteudo.edit', compact('pagina', 'config', 'alterados'));
    }

    public function update(Request $request, string $pagina)
    {
        $config = config("conteudo.$pagina") ?? abort(404);

        // As chaves têm ponto (home.agenda.titulo), então os campos chegam como arrays e não pelo input('a.b')
        $textos    = (array) $request->input('campos', []);
        $arquivos  = (array) $request->file('arquivos', []);
        $restaurar = (array) $request->input('restaurar', []);

        $regras = [];
        $nomes = [];
        foreach ($config['secoes'] as $secao) {
            foreach ($secao['campos'] as $chave => $campo) {
                $id = md5($chave);
                $nomes[$id] = $campo['rotulo'];
                $regras[$id] = $campo['tipo'] === 'imagem'
                    ? 'nullable|file|mimes:jpg,jpeg,png,webp,gif,svg,ico|max:4096'
                    : 'nullable|string|max:' . (in_array($campo['tipo'], ['textarea', 'lista']) ? 5000 : 500);
            }
        }

        $dados = [];
        foreach ($config['secoes'] as $secao) {
            foreach ($secao['campos'] as $chave => $campo) {
                $dados[md5($chave)] = $campo['tipo'] === 'imagem' ? ($arquivos[$chave] ?? null) : ($textos[$chave] ?? null);
            }
        }

        Validator::make($dados, $regras, [
            'mimes'    => 'O campo ":attribute" precisa ser uma imagem JPG, PNG, WEBP, GIF, SVG ou ICO.',
            'file.max' => 'A imagem do campo ":attribute" pode ter no máximo 4 MB.',
            'string.max' => 'O campo ":attribute" está grande demais.',
            'uploaded' => 'Não foi possível enviar a imagem do campo ":attribute" (talvez seja grande demais).',
        ], $nomes)->validate();

        $alterados = Conteudo::alterados();
        $mudou = 0;

        foreach ($config['secoes'] as $secao) {
            foreach ($secao['campos'] as $chave => $campo) {
                $antes = $alterados[$chave] ?? null;

                if (!empty($restaurar[$chave])) {
                    if ($antes !== null) {
                        Conteudo::where('chave_conteudo', $chave)->delete();
                        $this->apagarImagemSeNaoUsada($campo, $antes, $chave);
                        $mudou++;
                    }
                    continue;
                }

                if ($campo['tipo'] === 'imagem') {
                    if (isset($arquivos[$chave])) {
                        Conteudo::definir($chave, $this->salvarImagem($arquivos[$chave], $chave));
                        $this->apagarImagemSeNaoUsada($campo, $antes, $chave);
                        $mudou++;
                    }
                    continue;
                }

                if (!array_key_exists($chave, $textos)) continue;

                // Quebras de linha do navegador (\r\n) e espaços nas pontas
                $valor = trim(str_replace("\r\n", "\n", (string) $textos[$chave]));
                if ($campo['tipo'] === 'lista') {
                    $valor = implode("\n", array_filter(array_map('trim', explode("\n", $valor)), 'strlen'));
                }

                if ($valor !== Conteudo::valor($chave)) {
                    Conteudo::definir($chave, $valor);
                    $mudou++;
                }
            }
        }

        Conteudo::limparCache();

        $mensagem = $mudou
            ? "Pronto! {$mudou} " . ($mudou == 1 ? 'campo atualizado' : 'campos atualizados') . ' no site.'
            : 'Nada foi alterado.';

        return redirect()->route('admin.conteudo.edit', $pagina)
            ->with('sucesso', $mensagem)
            ->with('secao', $request->input('secao_atual'));
    }

    private function chavesDaPagina(array $pagina): array
    {
        $chaves = [];
        foreach ($pagina['secoes'] as $secao) {
            $chaves = array_merge($chaves, array_keys($secao['campos']));
        }

        return $chaves;
    }

    private function salvarImagem($arquivo, string $chave): string
    {
        // Ex.: 1729612345_home-sabor-imagem.jpg
        $nome = time() . '_' . str_replace(['.', '_'], '-', $chave) . '.' . strtolower($arquivo->getClientOriginalExtension());

        try {
            $arquivo->move(public_path(Conteudo::PASTA), $nome);
        } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'arquivos' => 'Não foi possível gravar a imagem no servidor. Verifique a permissão da pasta public/' . Conteudo::PASTA . '.',
            ]);
        }

        return Conteudo::PASTA . '/' . $nome;
    }

    // Só apaga imagens enviadas pelo painel (nunca as originais do site) e que não estejam em outro campo
    private function apagarImagemSeNaoUsada(array $campo, ?string $caminho, string $chave): void
    {
        if ($campo['tipo'] !== 'imagem' || !$caminho || !str_starts_with($caminho, Conteudo::PASTA . '/')) return;

        $emUso = Conteudo::where('valor_conteudo', $caminho)->where('chave_conteudo', '!=', $chave)->exists();
        $arquivo = public_path(Conteudo::PASTA . '/' . basename($caminho));

        if (!$emUso && is_file($arquivo)) {
            @unlink($arquivo);
        }
    }
}
