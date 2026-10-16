<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    protected $table = 'tbl_materia_prima';
    protected $primaryKey = 'id_materia_prima';

    // criado_em_materia_prima e atualizado_em_materia_prima são preenchidos pelo banco
    public $timestamps = false;

    protected $fillable = [
        'id_fornecedor',
        'nome_materia_prima',
        'unid_med_materia_prima',
        'qtde_atual_materia_prima', // só muda pelas movimentações de estoque
    ];

    // Unidades aceitas (a coluna tem 2 caracteres)
    const UNIDADES = [
        'KG' => 'Quilo (KG)',
        'G'  => 'Grama (G)',
        'L'  => 'Litro (L)',
        'ML' => 'Mililitro (ML)',
        'UN' => 'Unidade (UN)',
        'CX' => 'Caixa (CX)',
        'PC' => 'Pacote (PC)',
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'id_fornecedor', 'id_fornecedor');
    }

    public function movimentacoes()
    {
        return $this->hasMany(MovimentacaoEstoque::class, 'id_materia_prima', 'id_materia_prima');
    }
}
