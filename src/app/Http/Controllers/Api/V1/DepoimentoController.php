<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Depoimento;
use Illuminate\Http\Request;

class DepoimentoController extends Controller
{
    // GET /api/v1/depoimentos
    // Depoimentos do cliente logado, do mais novo para o mais antigo, com a situação de cada um
    public function index(Request $request)
    {
        $depoimentos = Depoimento::where('id_cliente', $request->user()->id_cliente)
            ->orderByDesc('criado_em_depoimento')
            ->orderByDesc('id_depoimento')
            ->get()
            ->map(fn ($d) => $this->formatar($d));

        return response()->json(['success' => true, 'data' => $depoimentos]);
    }

    // POST /api/v1/depoimentos
    // O depoimento entra como PENDENTE e só aparece no site depois de aprovado no painel
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nota'  => 'required|integer|between:1,5',
            'texto' => 'required|string|min:5|max:1000',
        ], [
            'nota.required'  => 'Escolha uma nota de 1 a 5 estrelas.',
            'nota.between'   => 'Escolha uma nota de 1 a 5 estrelas.',
            'texto.required' => 'Escreva o seu depoimento.',
            'texto.min'      => 'O depoimento precisa ter pelo menos 5 caracteres.',
            'texto.max'      => 'O depoimento aceita no máximo 1000 caracteres.',
        ]);

        $depoimento = Depoimento::create([
            'id_cliente'        => $request->user()->id_cliente,
            'nota_depoimento'   => $dados['nota'],
            'texto_depoimento'  => trim($dados['texto']),
            'status_depoimento' => 'PENDENTE',
            // horário de Brasília, igual aos pedidos (o Laravel está em UTC)
            'criado_em_depoimento' => now('America/Sao_Paulo'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Obrigado! Seu depoimento foi enviado e será publicado após a análise.',
            'data'    => $this->formatar($depoimento->fresh()),
        ], 201);
    }

    private function formatar(Depoimento $d)
    {
        return [
            'id'        => $d->id_depoimento,
            'nota'      => (int) $d->nota_depoimento,
            'texto'     => $d->texto_depoimento,
            'status'    => $d->status_depoimento,
            'situacao'  => Depoimento::STATUS[$d->status_depoimento] ?? $d->status_depoimento,
            'criado_em' => $d->criado_em_depoimento,
        ];
    }
}
