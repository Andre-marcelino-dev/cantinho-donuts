<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\NovaMensagemContato;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    // POST /api/v1/contato
    // Mensagem do "Fale conosco" do app. Nome, e-mail e telefone vêm do cadastro do cliente logado.
    // Grava na mesma tabela do formulário do site, então aparece no painel em Mensagens de contato.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'assunto'  => 'required|string|max:30',
            'mensagem' => 'required|string|max:2000',
        ], [
            'assunto.required'  => 'Informe o assunto.',
            'assunto.max'       => 'O assunto aceita no máximo 30 caracteres.',
            'mensagem.required' => 'Escreva a mensagem.',
            'mensagem.max'      => 'A mensagem aceita no máximo 2000 caracteres.',
        ]);

        $cliente = $request->user();

        $contato = Contato::create([
            'nome_contato'     => mb_substr((string) $cliente->nome_cliente, 0, 50),
            'email_contato'    => mb_substr((string) $cliente->email_cliente, 0, 80),
            'telefone_contato' => mb_substr((string) $cliente->telefone_cliente, 0, 14),
            'assunto_contato'  => trim($dados['assunto']),
            'mensagem_contato' => trim($dados['mensagem']),
            'status_contato'   => 'ENVIADO',
        ]);

        // Avisa a loja por e-mail. Se o envio falhar, a mensagem continua salva no painel.
        $destino = config('mail.contato_destino');
        if ($destino) {
            try {
                Mail::to($destino)->send(new NovaMensagemContato($contato));
            } catch (\Throwable $erro) {
                Log::error('Falha ao enviar o aviso de contato (app) por e-mail: ' . $erro->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Mensagem enviada! Em breve entraremos em contato.',
        ], 201);
    }
}
