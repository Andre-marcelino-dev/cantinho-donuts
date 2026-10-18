<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova mensagem do site</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.5;">
    <h2 style="color: #e8932e; margin-bottom: 4px;">Nova mensagem pelo site</h2>
    <p style="margin-top: 0; color: #777;">Recebida em {{ now('America/Sao_Paulo')->format('d/m/Y') }} às {{ now('America/Sao_Paulo')->format('H:i') }}</p>

    <table cellpadding="6" style="border-collapse: collapse;">
        <tr><td><strong>Nome:</strong></td><td>{{ $contato->nome_contato }}</td></tr>
        <tr><td><strong>E-mail:</strong></td><td>{{ $contato->email_contato }}</td></tr>
        <tr><td><strong>Telefone:</strong></td><td>{{ $contato->telefone_contato }}</td></tr>
        <tr><td><strong>Assunto:</strong></td><td>{{ $contato->assunto_contato }}</td></tr>
    </table>

    <h3 style="margin-bottom: 4px;">Mensagem</h3>
    <p style="white-space: pre-line; background: #f7f3ee; padding: 12px; border-radius: 6px;">{{ $contato->mensagem_contato }}</p>

    <p style="color: #777; font-size: 13px;">
        Para responder, use o botão "Responder" do seu e-mail ou veja a mensagem no painel admin
        em Site → Mensagens de contato.
    </p>
</body>
</html>
