<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'tbl_fornecedores';
    protected $primaryKey = 'id_fornecedor';

    // criado_em_fornecedor e atualizado_em_fornecedor são preenchidos pelo banco
    public $timestamps = false;

    protected $fillable = [
        'nome_fornecedor',
        'representante_fornecedor',
        'email_fornecedor',
        'telefone_fornecedor',
        'status_fornecedor',
    ];

    public function materiasPrimas()
    {
        return $this->hasMany(MateriaPrima::class, 'id_fornecedor', 'id_fornecedor');
    }
}
