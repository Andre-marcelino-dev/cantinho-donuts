<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depoimento extends Model
{
    protected $table = 'tbl_depoimentos';
    protected $primaryKey = 'id_depoimento';

    // criado_em_depoimento e atualizado_em_depoimento são preenchidos pelo banco
    public $timestamps = false;

    // status_depoimento tem no máximo 10 caracteres
    const STATUS = [
        'PENDENTE' => 'Em análise',
        'APROVADO' => 'Publicado',
        'RECUSADO' => 'Não publicado',
    ];

    protected $fillable = [
        'id_cliente',
        'texto_depoimento',
        'nota_depoimento',
        'status_depoimento',
        'criado_em_depoimento',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
