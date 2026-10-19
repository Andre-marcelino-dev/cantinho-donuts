<?php
 
use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\Api\V1\StatusController;
use App\Http\Controllers\Api\V1\BannerController;
use App\Http\Controllers\Api\V1\CategoriaController;
use App\Http\Controllers\Api\V1\ProdutoController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ClienteController;
use App\Http\Controllers\Api\V1\SacolaController;
use App\Http\Controllers\Api\V1\PedidoController;
use App\Http\Controllers\Api\V1\EnderecoController;
use App\Http\Controllers\Api\V1\CupomController;
use App\Http\Controllers\Api\V1\ConfiguracaoController;
use App\Http\Controllers\Api\V1\ContatoController;
use App\Http\Controllers\Api\V1\DepoimentoController;
 
Route::prefix('v1')->group(function () {
 
    // Status da API
    Route::get('/status', [StatusController::class, 'index']);
 
    // Banners
    Route::get('/banners', [BannerController::class, 'index']);
 
    // Categorias
    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::get('/categorias/{id}/produtos', [CategoriaController::class, 'produtos']);
 
    // Produtos
    Route::get('/produtos', [ProdutoController::class, 'index']);
    Route::get('/produtos/{slug}', [ProdutoController::class, 'show']);
 
    // Taxa e previsão de entrega (definidas no painel)
    Route::get('/configuracoes', [ConfiguracaoController::class, 'index']);

    // LOGIN - rota pública
    Route::post('/auth/login', [AuthController::class, 'login']);
 
    // ROTAS COM CREDENCIAL
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/cliente', [ClienteController::class, 'show']);
        Route::put('/cliente', [ClienteController::class, 'update']);
        Route::patch('/cliente', [ClienteController::class, 'update']);
        Route::put('/cliente/senha', [ClienteController::class, 'updateSenha']);
        Route::post('/cliente/foto', [ClienteController::class, 'updateFoto']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);

        // Sacola do cliente logado
        Route::get('/sacola', [SacolaController::class, 'index']);
        Route::post('/sacola', [SacolaController::class, 'store']);
        Route::put('/sacola/{id}', [SacolaController::class, 'update']);
        Route::patch('/sacola/{id}', [SacolaController::class, 'update']);
        Route::delete('/sacola/{id}', [SacolaController::class, 'destroy']);

        // Pedidos do cliente logado
        Route::get('/pedidos', [PedidoController::class, 'index']);
        Route::post('/pedidos', [PedidoController::class, 'store']);
        Route::get('/pedidos/{id}', [PedidoController::class, 'show']);

        // Validar cupom de desconto (o desconto é aplicado no POST /pedidos)
        Route::get('/cupons/{codigo}', [CupomController::class, 'show']);

        // Fale conosco do app (no máximo 5 mensagens por minuto)
        Route::post('/contato', [ContatoController::class, 'store'])->middleware('throttle:5,1');

        // Depoimentos do cliente logado (só aparecem no site depois de aprovados no painel)
        Route::get('/depoimentos', [DepoimentoController::class, 'index']);
        Route::post('/depoimentos', [DepoimentoController::class, 'store'])->middleware('throttle:5,1');

        // Endereços de entrega do cliente logado
        Route::get('/enderecos', [EnderecoController::class, 'index']);
        Route::post('/enderecos', [EnderecoController::class, 'store']);
        Route::get('/enderecos/{id}', [EnderecoController::class, 'show']);
        Route::put('/enderecos/{id}', [EnderecoController::class, 'update']);
        Route::patch('/enderecos/{id}', [EnderecoController::class, 'update']);
        Route::patch('/enderecos/{id}/principal', [EnderecoController::class, 'principal']);
        Route::delete('/enderecos/{id}', [EnderecoController::class, 'destroy']);
    });
 
});
