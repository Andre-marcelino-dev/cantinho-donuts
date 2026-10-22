<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

// Textos e imagens do site editados no painel (tbl_conteudos).
// Os campos e o texto original de cada um ficam em config/conteudo.php
class Conteudo extends Model
{
    protected $table = 'tbl_conteudos';
    protected $primaryKey = 'id_conteudo';

    // atualizado_em_conteudo é preenchido pelo banco
    public $timestamps = false;

    protected $fillable = [
        'chave_conteudo',
        'valor_conteudo',
    ];

    const CACHE = 'conteudos_site';

    // Pasta das imagens enviadas pelo painel
    const PASTA = 'davilla/images/conteudo';

    private static ?array $alterados = null;
    private static ?array $campos = null;

    // Tudo que foi alterado no painel, numa consulta só (fica em cache até salvar de novo)
    public static function alterados(): array
    {
        if (self::$alterados === null) {
            try {
                self::$alterados = Cache::rememberForever(self::CACHE, function () {
                    return self::pluck('valor_conteudo', 'chave_conteudo')->all();
                });
            } catch (\Throwable $e) {
                // Tabela ainda não criada (antes do migrate): o site usa os textos originais
                self::$alterados = [];
            }
        }

        return self::$alterados;
    }

    // Todos os campos de config/conteudo.php, por chave
    public static function campos(): array
    {
        if (self::$campos === null) {
            self::$campos = [];
            foreach (config('conteudo', []) as $pagina) {
                foreach ($pagina['secoes'] as $secao) {
                    foreach ($secao['campos'] as $chave => $campo) {
                        self::$campos[$chave] = $campo;
                    }
                }
            }
        }

        return self::$campos;
    }

    public static function padrao(string $chave): string
    {
        return self::campos()[$chave]['padrao'] ?? '';
    }

    public static function valor(string $chave): string
    {
        return self::alterados()[$chave] ?? self::padrao($chave);
    }

    public static function definir(string $chave, string $valor): void
    {
        // Igual ao original: apaga, assim o campo volta a seguir o texto do código
        if ($valor === self::padrao($chave)) {
            self::where('chave_conteudo', $chave)->delete();
        } else {
            self::updateOrCreate(['chave_conteudo' => $chave], ['valor_conteudo' => $valor]);
        }
    }

    public static function limparCache(): void
    {
        Cache::forget(self::CACHE);
        self::$alterados = null;
    }
}
