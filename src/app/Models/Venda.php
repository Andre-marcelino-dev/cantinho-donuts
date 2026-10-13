<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Cupom;
use App\Models\ItemVenda;

class Venda extends Model
{
    protected $table = 'tbl_vendas';
    protected $primaryKey = 'id_venda';

    // data_venda é preenchida pelo PedidoController (horário de Brasília)
    // e atualizado_em_venda pelo próprio banco
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'data_venda',
        'id_usuario',
        'id_endereco',
        'id_cupom',
        'valor_venda',
        'status_venda',
        'data_entrega_venda',
        'forma_pagamento_venda',
        'entrega_venda',
        'observacao_venda',
        'valor_desconto_venda',
    ];

    // Relacionamento: uma venda tem vários itens
    public function itens()
    {
        return $this->hasMany(ItemVenda::class, 'id_venda', 'id_venda');
    }

    // Relacionamento: a venda pertence a um cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // Relacionamento: a venda pode ter um cupom
    public function cupom()
    {
        return $this->belongsTo(Cupom::class, 'id_cupom', 'id_cupom');
    }
}
