<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mail\NovaMensagemContato;
use App\Models\Contato;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ContatoController extends Controller
{
    public function contato()
    {
        // Assuntos do formulário: editados no painel (Conteúdo do Site → Páginas → Contato), um por linha.
        // A coluna assunto_contato aceita até 30 caracteres.
        $assuntos = array_map(fn ($a) => mb_substr($a, 0, 30), conteudo_lista('contato.formulario.assuntos')) ?: ['Outro'];

        return view('site.contato.contato', compact('assuntos'));
    }

    // POST /contato — usado pelo formulário da página de contato e pelo do rodapé
    public function enviar(Request $request)
    {
        // "origem" diz qual formulário enviou, para mostrar a mensagem no lugar certo
        $origem = $request->input('origem') === 'rodape' ? 'rodape' : 'contato';

        $dados = $request->validateWithBag($origem, [
            'nome_contato'     => 'required|string|max:50',
            'email_contato'    => 'required|email|max:80',
            'telefone_contato' => 'required|string|max:14',
            'assunto_contato'  => 'required|string|max:30',
            'mensagem_contato' => 'required|string|max:2000',
        ], [
            'required' => 'Preencha o campo :attribute.',
            'email'    => 'Informe um e-mail válido.',
            'max'      => 'O campo :attribute aceita no máximo :max caracteres.',
        ], [
            'nome_contato'     => 'nome',
            'email_contato'    => 'e-mail',
            'telefone_contato' => 'telefone',
            'assunto_contato'  => 'assunto',
            'mensagem_contato' => 'mensagem',
        ]);

        $contato = Contato::create($dados + ['status_contato' => 'ENVIADO']);

        // Avisa a loja por e-mail. Se o envio falhar, a mensagem continua salva no painel.
        $destino = config('mail.contato_destino');
        if ($destino) {
            try {
                Mail::to($destino)->send(new NovaMensagemContato($contato));
            } catch (\Throwable $erro) {
                Log::error('Falha ao enviar o aviso de contato por e-mail: ' . $erro->getMessage());
            }
        }

        return redirect()->back()
            ->with("sucesso_{$origem}", 'Mensagem enviada! Em breve entraremos em contato.');
    }
}
