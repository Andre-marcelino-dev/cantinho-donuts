<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoCliente extends Model
{
    protected $table = 'tbl_enderecos_cliente';
    protected $primaryKey = 'id_endereco';

    // criado_em_endereco e atualizado_em_endereco são preenchidos pelo banco
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'nome_endereco',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'principal_endereco',
        'status_endereco',
    ];
}
