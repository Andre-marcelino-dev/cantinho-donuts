<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'tbl_banner';
    protected $primaryKey = 'id_banner';

    // tbl_banner não tem colunas de data de criação/atualização
    public $timestamps = false;

    protected $fillable = [
        'nome_banner',
        'titulo_banner',
        'ordem_banner',
        'foto_banner',
        'status_banner',
    ];

}
