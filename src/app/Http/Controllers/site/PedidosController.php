<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Produto;


class PedidosController extends Controller
{
    // Página "Faça seu pedido": como pedir + produtos com botão de WhatsApp
    public function pedidos()
    {
        // Os destaques primeiro; depois os demais, em ordem alfabética
        $produtos = Produto::with('CategoriaProduto')
            ->where('status_produto', 'ATIVO')
            ->whereHas('CategoriaProduto', function ($query) {
                $query->where('status_categoria', 'ATIVO');
            })
            ->orderByRaw("destaque_produto = 'SIM' DESC")
            ->orderBy('nome_produto')
            ->limit(9)
            ->get();

        $whatsapp = preg_replace('/\D/', '', config('services.loja.whatsapp'));
        $linkApp = config('services.loja.app_url');

        return view('site.pedidos.pedidos', compact('produtos', 'whatsapp', 'linkApp'));
    }
}
