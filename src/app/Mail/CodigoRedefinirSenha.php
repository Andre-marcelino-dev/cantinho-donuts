<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

// E-mail com o código para o cliente criar uma nova senha no app
class CodigoRedefinirSenha extends Mailable
{
    public function __construct(public string $nome, public string $codigo, public int $minutos)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Seu código para redefinir a senha: {$this->codigo}",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.codigo-redefinir-senha');
    }
}
