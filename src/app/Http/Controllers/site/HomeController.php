<?php

namespace App\Http\Controllers\site;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Banner;
use App\Models\Evento;
use App\Models\Kits;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class HomeController extends Controller
{


    // Metodo Home - Carregar a index

    public function home()
    {
      

    // Categorias
    $filtroCategoria = Categoria::where('status_categoria', 'ATIVO')
        ->orderBy('ordem_categoria')
        ->get();

        // dd($filtroCategoria);

          // Todos produtos
    $listaProduto = Produto::with('CategoriaProduto')
        ->where('status_produto', 'ATIVO')
        ->inRandomOrder()
        ->limit(8)
        ->get();


        $listaBanner = Banner::where('status_banner', 'ATIVO')
        ->inRandomOrder()
        ->get();

         $kitis = Kits::with('ProdutosKit.produto')

        ->get();

        // dd($kitis  );

        $listaEvento = Evento::where('status_evento', 'ATIVO')
        ->orderBy('data_evento')
        ->orderBy('ordem_evento')
        ->get();
        //dd($listaEvento);

        return view('site.home.home', compact('filtroCategoria','listaProduto', 'listaBanner','kitis','listaEvento'));
    }
}
