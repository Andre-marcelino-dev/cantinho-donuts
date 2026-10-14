<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cupom;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    // GET /api/v1/cupons/{codigo}
    // Diz se o cupom pode ser usado hoje e qual a porcentagem de desconto
    public function show(Request $request, string $codigo)
    {
        $cupom = Cupom::validoHoje($codigo);

        if (!$cupom) {
            return response()->json([
                'success' => false,
                'message' => 'Cupom inválido ou expirado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'codigo'     => $cupom->codigo_cupom,
                'percentual' => (float) $cupom->valor_desconto_cupom,
                'valido_ate' => $cupom->data_fim_cupom,
            ],
        ]);
    }
}
