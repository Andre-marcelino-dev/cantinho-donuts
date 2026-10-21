<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuracao;


class ConfiguracaoController extends Controller
{
    public function index()
    {
        $taxaEntrega = Configuracao::taxaEntrega();
        $previsaoEntrega = Configuracao::previsaoEntrega();
        $lojaLatitude = Configuracao::valor('loja_latitude');
        $lojaLongitude = Configuracao::valor('loja_longitude');

        return view('admin.configuracao.index', compact('taxaEntrega', 'previsaoEntrega', 'lojaLatitude', 'lojaLongitude'));
    }

    public function update(Request $request)
    {
        // Aceita "6,50" (vírgula) além de "6.50"
        $request->merge(['taxa_entrega' => str_replace(',', '.', (string) $request->taxa_entrega)]);

        $dados = $request->validate([
            'taxa_entrega'     => 'required|numeric|min:0|max:999',
            'previsao_entrega' => 'required|string|max:30',
            // Localização da loja para calcular a distância das zonas de entrega (vazio = buscar pelo CEP)
            'loja_latitude'    => 'nullable|required_with:loja_longitude|numeric|between:-90,90',
            'loja_longitude'   => 'nullable|required_with:loja_latitude|numeric|between:-180,180',
        ], [
            'loja_latitude.required_with'  => 'Preencha a latitude e a longitude juntas (ou deixe as duas vazias).',
            'loja_longitude.required_with' => 'Preencha a latitude e a longitude juntas (ou deixe as duas vazias).',
            'loja_latitude.numeric'        => 'A latitude precisa ser um número com ponto, ex.: -23.4987.',
            'loja_longitude.numeric'       => 'A longitude precisa ser um número com ponto, ex.: -46.3912.',
            'taxa_entrega.required'     => 'Informe a taxa de entrega (use 0 para entrega grátis).',
            'taxa_entrega.numeric'      => 'A taxa de entrega precisa ser um número, ex.: 6,50.',
            'taxa_entrega.min'          => 'A taxa de entrega não pode ser negativa.',
            'previsao_entrega.required' => 'Informe a previsão de entrega, ex.: 45 - 60 min.',
            'previsao_entrega.max'      => 'A previsão pode ter no máximo 30 caracteres.',
        ]);

        Configuracao::definir('taxa_entrega', number_format((float) $dados['taxa_entrega'], 2, '.', ''));
        Configuracao::definir('previsao_entrega', trim($dados['previsao_entrega']));
        Configuracao::definir('loja_latitude', (string) ($dados['loja_latitude'] ?? ''));
        Configuracao::definir('loja_longitude', (string) ($dados['loja_longitude'] ?? ''));

        return redirect()->route('admin.configuracao')->with('sucesso', 'Configurações salvas! O app já passa a usar os novos valores.');
    }
}
