<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Receitas do livro da Home (tbl_receitas)
class Receita extends Model
{
    protected $table = 'tbl_receitas';
    protected $primaryKey = 'id_receita';

    // tbl_receitas não tem colunas de data de criação/atualização
    public $timestamps = false;

    protected $fillable = [
        'titulo_receita',
        'destaque_receita',
        'intro_receita',
        'tempo_receita',
        'rendimento_receita',
        'nivel_receita',
        'cor_receita',
        'ingredientes_receita',
        'preparo_receita',
        'dica_receita',
        'ordem_receita',
        'status_receita',
    ];

    // Cor de destaque da página do livro => [nome no painel, cor]
    const CORES = [
        'rose'  => ['Rosa', '#b94e5c'],
        'gold'  => ['Dourado', '#b8893f'],
        'choco' => ['Chocolate', '#6b3a2a'],
    ];

    public static function ativas()
    {
        try {
            return self::where('status_receita', 'ATIVO')->orderBy('ordem_receita')->orderBy('id_receita')->get();
        } catch (\Throwable $e) {
            // Tabela ainda não criada (antes do migrate)
            return collect();
        }
    }

    public static function linhas(?string $texto): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $texto)), 'strlen'));
    }

    // No formato que o livro da Home usa
    public function paraLivro(): array
    {
        return [
            'titulo'       => $this->titulo_receita,
            'destaque'     => $this->destaque_receita,
            'intro'        => $this->intro_receita,
            'tempo'        => $this->tempo_receita,
            'rendimento'   => $this->rendimento_receita,
            'nivel'        => $this->nivel_receita,
            'cor'          => $this->cor_receita,
            'ingredientes' => self::linhas($this->ingredientes_receita),
            'preparo'      => self::linhas($this->preparo_receita),
            'dica'         => $this->dica_receita,
        ];
    }
}
