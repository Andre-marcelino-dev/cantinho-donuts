<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Configuracao;

class ConfiguracaoController extends Controller
{
    // GET /api/v1/configuracoes
    // Taxa e previsão de entrega definidas no painel admin, e o contato da loja (config/services.php)
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'taxa_entrega'     => Configuracao::taxaEntrega(),
                'previsao_entrega' => Configuracao::previsaoEntrega(),
                'whatsapp'         => config('services.loja.whatsapp'),
                'email'            => config('services.loja.email'),
            ],
        ]);
    }
}
