<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Sacola extends Model
{
    protected $table = 'tbl_sacola';
    protected $primaryKey = 'id_sacola';

    public $timestamps = true;

    const CREATED_AT = 'criado_em_sacola';
    const UPDATED_AT = 'atualizado_em_sacola';

    protected $fillable = [
        'id_cliente',
        'id_produto',
        'qtde_sacola',
    ];

    // Relacionamento: cada item da sacola aponta para um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}
