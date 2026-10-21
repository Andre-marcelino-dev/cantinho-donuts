<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\ZonaEntrega;
use App\Services\AreaEntrega;
use Illuminate\Http\Request;

class RegiaoController extends Controller
{
    public function regiao()
    {
        $zonas = ZonaEntrega::ativas();

        return view('site.regiao.regiao', compact('zonas'));
    }

    // GET /regiao/consultar?cep=00000000
    // Usado pelo "Será que a gente chega até você?" da página Região
    public function consultar(Request $request)
    {
        $consulta = AreaEntrega::consultar((string) $request->query('cep', ''));
        $zona = $consulta['zona'];

        return response()->json([
            'status'       => $consulta['status'],
            'cep'          => $consulta['cep'],
            'bairro'       => $consulta['bairro'],
            'cidade'       => $consulta['cidade'] ? $consulta['cidade'] . ($consulta['uf'] ? '/' . $consulta['uf'] : '') : null,
            'distancia_km' => $consulta['distancia_km'],
            'zona'         => $zona ? [
                'id'    => $zona->id_zona_entrega,
                'nome'  => $zona->nome_zona_entrega,
                'taxa'  => $zona->taxaFormatada(),
                'prazo' => $zona->prazo_zona_entrega,
            ] : null,
        ]);
    }
}
