<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = 'tbl_contato';
    protected $primaryKey = 'id_contato';

    // criado_em_contato e atualizado_em_contato são preenchidos pelo banco
    public $timestamps = false;

    protected $fillable = [
        'nome_contato',
        'email_contato',
        'telefone_contato',
        'assunto_contato',
        'mensagem_contato',
        'status_contato',
    ];
}
