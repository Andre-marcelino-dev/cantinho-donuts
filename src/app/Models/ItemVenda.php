<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class ItemVenda extends Model
{
    protected $table = 'tbl_itens_venda';
    protected $primaryKey = 'id_item';

    // A tabela só tem a coluna de atualização
    public $timestamps = true;

    const CREATED_AT = null;
    const UPDATED_AT = 'atualizado_em_item';

    protected $fillable = [
        'id_venda',
        'id_produto',
        'valor_unit_item',
        'qtde_item',
        'status_item',
    ];

    // Relacionamento: cada item aponta para um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}
