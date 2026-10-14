<?php

namespace App\Mail;

use App\Models\Contato;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

// E-mail que avisa a loja quando chega uma mensagem pelo formulário de contato
class NovaMensagemContato extends Mailable
{
    public function __construct(public Contato $contato)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nova mensagem do site: {$this->contato->assunto_contato} — {$this->contato->nome_contato}",
            // "Responder" no e-mail já vai direto para quem escreveu
            replyTo: [new Address($this->contato->email_contato, $this->contato->nome_contato)],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.nova-mensagem-contato');
    }
}
