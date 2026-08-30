<?php

use App\Http\Controllers\site\CardapioController;
use App\Http\Controllers\site\ContatoController;
use App\Http\Controllers\site\HomeController;
use App\Http\Controllers\site\PedidosController;
use App\Http\Controllers\site\RegiaoController;
use App\Http\Controllers\site\SobreController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\UsuarioController;
use App\Http\Controllers\admin\DashController;
use App\Http\Controllers\admin\CategoriaController;
use App\Http\Controllers\admin\ProdutoController;
use App\Http\Controllers\admin\ClienteController;
use App\Http\Controllers\admin\EventoController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\Cliente\AuthController as ClienteAuthController;

// Rotas do site
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');
Route::get('/cardapio', [CardapioController::class, 'cardapio'])->name('cardapio.index');
Route::get('/cardapio/categoria/{id}', [CardapioController::class, 'show'])->name('cardapio.categoria');
Route::get('/cardapio/produto/{slug}', [CardapioController::class, 'showProduto'])->name('cardapio.produto');
Route::get('/pedidos', [PedidosController::class, 'pedidos'])->name('pedidos');
Route::get('/regiao', [RegiaoController::class, 'regiao'])->name('regiao.index');
Route::get('/regiao/area/{id}', [RegiaoController::class, 'show'])->name('regiao.area');
Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');

// Rotas do admin
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'autenticar'])->name('login.autenticar');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {

        Route::get('/', [DashController::class, 'index'])->name('dash');

        Route::resource('usuarios', \App\Http\Controllers\admin\UsuarioController::class)
            ->parameters(['usuarios' => 'usuario']);

        Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria');
        Route::post('/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
        Route::put('/categoria/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
        Route::patch('/categoria/{id}/status', [CategoriaController::class, 'alterarStatus'])->name('categoria.status');

        Route::get('/produto', [ProdutoController::class, 'index'])->name('produto');
        Route::post('/produto', [ProdutoController::class, 'store'])->name('produto.store');
        Route::put('/produto/{id}', [ProdutoController::class, 'update'])->name('produto.update');
        Route::patch('/produto/{id}/status', [ProdutoController::class, 'alterarStatus'])->name('produto.status');
        Route::delete('/produto/{id}', [ProdutoController::class, 'destroy'])->name('produto.destroy');

        Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente');
        Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
        Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
        Route::patch('/cliente/{id}/status', [ClienteController::class, 'status'])->name('cliente.status');
        Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

        Route::get('/evento', [EventoController::class, 'index'])->name('evento');
        Route::post('/evento', [EventoController::class, 'store'])->name('evento.store');
        Route::put('/evento/{id}', [EventoController::class, 'update'])->name('evento.update');
        Route::patch('/evento/{id}/status', [EventoController::class, 'alterarStatus'])->name('evento.status');
        Route::delete('/evento/{id}', [EventoController::class, 'destroy'])->name('evento.destroy');

    });

}); // ← fecha o grupo admin aqui

// ─── Área do Cliente ─────────────────────────────────────────── (fora do admin!)
Route::prefix('cliente')->name('cliente.')->group(function () {

    Route::middleware('guest:cliente')->group(function () {
        Route::get('/login',  [ClienteAuthController::class, 'login'])->name('login');
        Route::post('/login', [ClienteAuthController::class, 'autenticar'])->name('autenticar');
    });

    Route::middleware('auth:cliente')->group(function () {
        Route::get('/dashboard', fn() => view('cliente.dash'))->name('dash');
        Route::post('/logout',   [ClienteAuthController::class, 'logout'])->name('logout');
    });

});
