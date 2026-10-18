<?php

namespace App\Providers;

use App\Models\Categoria;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
// use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $categorias = Categoria::orderBy('nome_categoria')->get();
            $view->with('lista', $categorias);
            $view->with('categorias', $categorias);
            $view->with('filtroCategoria', $categorias);
        });

        // Dados da loja (config/services.php) com o telefone já formatado: (11) 98816-1211
        View::composer('*', function ($view) {
            $loja = config('services.loja');
            $numero = preg_replace('/^55/', '', preg_replace('/\D/', '', $loja['whatsapp']));
            $loja['telefone'] = strlen($numero) === 11
                ? sprintf('(%s) %s-%s', substr($numero, 0, 2), substr($numero, 2, 5), substr($numero, 7))
                : $numero;
            $loja['mapa'] = "{$loja['endereco']}, {$loja['cep']}, {$loja['cidade']}";
            $view->with('loja', $loja);
        });
    }
}
