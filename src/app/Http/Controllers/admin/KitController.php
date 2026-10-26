<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Kits;
use App\Models\itensKit;
use App\Models\Produto;


class KitController extends Controller
{
    // Etiquetas que a Home do site sabe mostrar (destaque_kit)
    const DESTAQUES = [
        'NENHUM'       => 'Nenhuma',
        'MAIS VENDIDO' => 'Mais vendido',
        'PROMOCAO'     => 'Promoção',
        'NOVIDADE'     => 'Novidade',
    ];

    // As fotos de kit ficam em public/donuts/images/kit (foto_kit guarda "kit/arquivo")
    const PASTA = 'donuts/images/kit';

    public function index()
    {
        $kits = Kits::with('ProdutosKit.produto')->orderBy('nome_kit')->get();
        $produtos = Produto::where('status_produto', 'ATIVO')->orderBy('nome_produto')->get();
        $destaques = self::DESTAQUES;
        $whatsappLoja = preg_replace('/\D/', '', config('services.loja.whatsapp'));

        return view('admin.kit.index', compact('kits', 'produtos', 'destaques', 'whatsappLoja'));
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request, true);

        DB::transaction(function () use ($request, $dados) {
            $kit = new Kits($this->camposDoKit($dados));
            $kit->slug_kit = $this->slugUnico($dados['nome_kit']);
            $kit->foto_kit = $request->hasFile('foto_kit')
                ? $this->salvarFoto($request)
                : $this->fotoDoPrimeiroProduto($dados['produtos']);
            $kit->save();

            $this->salvarProdutos($kit, $dados['produtos']);
        });

        return redirect()->route('admin.kit')->with('sucesso', 'Kit criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $kit = Kits::findOrFail($id);
        $dados = $this->validar($request, false);

        DB::transaction(function () use ($request, $dados, $kit) {
            $kit->fill($this->camposDoKit($dados));
            if ($kit->isDirty('nome_kit')) {
                $kit->slug_kit = $this->slugUnico($dados['nome_kit'], $kit->id_kit);
            }
            if ($request->hasFile('foto_kit')) {
                $fotoAntiga = $kit->foto_kit;
                $kit->foto_kit = $this->salvarFoto($request);
                $this->apagarFotoDeKit($fotoAntiga);
            }
            $kit->save();

            $this->salvarProdutos($kit, $dados['produtos']);
        });

        return redirect()->route('admin.kit')->with('sucesso', 'Kit atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $kit = Kits::findOrFail($id);

        DB::transaction(function () use ($kit) {
            itensKit::where('id_kit', $kit->id_kit)->delete();
            $this->apagarFotoDeKit($kit->foto_kit);
            $kit->delete();
        });

        return redirect()->route('admin.kit')->with('sucesso', 'Kit excluído.');
    }

    private function validar(Request $request, bool $novo): array
    {
        // Aceita preço com vírgula (ex.: 49,90)
        $request->merge([
            'preco_kit' => str_replace(',', '.', (string) $request->preco_kit),
            'preco_promocional_kit' => $request->filled('preco_promocional_kit')
                ? str_replace(',', '.', (string) $request->preco_promocional_kit) : null,
        ]);

        return $request->validate([
            'nome_kit'              => 'required|string|max:30',
            'descricao_kit'         => 'required|string|max:1000',
            'preco_kit'             => 'required|numeric|min:0',
            'preco_promocional_kit' => 'nullable|numeric|min:0|lt:preco_kit',
            'destaque_kit'          => 'required|in:' . implode(',', array_keys(self::DESTAQUES)),
            'whatsapp_kit'          => 'nullable|string|max:20',
            'foto_kit'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'produtos'              => 'required|array|min:1',
            'produtos.*'            => 'integer|exists:tbl_produtos,id_produto',
        ], [
            'nome_kit.required'        => 'Informe o nome do kit.',
            'nome_kit.max'             => 'O nome do kit pode ter no máximo 30 caracteres.',
            'descricao_kit.required'   => 'Informe a descrição do kit.',
            'preco_kit.required'       => 'Informe o preço do kit.',
            'preco_kit.numeric'        => 'O preço precisa ser um número, ex.: 49,90.',
            'preco_promocional_kit.lt' => 'O preço promocional precisa ser menor que o preço normal.',
            'produtos.required'        => 'Escolha pelo menos um produto para o kit.',
            'foto_kit.image'           => 'A foto precisa ser uma imagem.',
            'foto_kit.max'             => 'A foto pode ter no máximo 2 MB.',
        ]);
    }

    private function camposDoKit(array $dados): array
    {
        return [
            'nome_kit'              => trim($dados['nome_kit']),
            'descricao_kit'         => trim($dados['descricao_kit']),
            'preco_kit'             => $dados['preco_kit'],
            'preco_promocional_kit' => $dados['preco_promocional_kit'] ?? null,
            'destaque_kit'          => $dados['destaque_kit'],
            'whatsapp_kit'          => $this->whatsappComPais($dados['whatsapp_kit'] ?? ''),
        ];
    }

    // O link wa.me precisa do código do país: "(11) 98816-1211" vira "5511988161211"
    private function whatsappComPais(string $telefone): ?string
    {
        $numeros = preg_replace('/\D/', '', $telefone);
        if ($numeros === '') return null;

        return strlen($numeros) <= 11 ? '55' . $numeros : $numeros;
    }

    // Os itens do kit são recriados com os produtos marcados
    private function salvarProdutos(Kits $kit, array $idsProdutos): void
    {
        itensKit::where('id_kit', $kit->id_kit)->delete();
        foreach (array_unique($idsProdutos) as $idProduto) {
            itensKit::create([
                'id_kit'          => $kit->id_kit,
                'id_produto'      => $idProduto,
                'status_item_kit' => 'ATIVO',
            ]);
        }
    }

    // slug_kit aceita até 30 caracteres e não pode repetir
    private function slugUnico(string $nome, $idIgnorado = null): string
    {
        $base = Str::limit(Str::slug($nome), 26, '');
        $slug = $base;
        $n = 2;
        while (Kits::where('slug_kit', $slug)->when($idIgnorado, fn ($q) => $q->where('id_kit', '!=', $idIgnorado))->exists()) {
            $slug = "{$base}-{$n}";
            $n++;
        }
        return $slug;
    }

    private function salvarFoto(Request $request): string
    {
        $arquivo = $request->file('foto_kit');
        $nome = time() . '_kit.' . $arquivo->extension();
        $arquivo->move(public_path(self::PASTA), $nome);

        return 'kit/' . $nome;
    }

    private function fotoDoPrimeiroProduto(array $idsProdutos): string
    {
        return Produto::whereIn('id_produto', $idsProdutos)->value('foto_produto') ?? '';
    }

    // Só apaga fotos da pasta de kits (nunca a foto de um produto)
    private function apagarFotoDeKit(?string $foto): void
    {
        if (!$foto || !str_starts_with($foto, 'kit/')) return;
        if (Kits::where('foto_kit', $foto)->count() > 1) return;

        $caminho = public_path('donuts/images/' . $foto);
        if (is_file($caminho)) @unlink($caminho);
    }
}
