<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Redefinir senha</title>
</head>
<body style="font-family: Arial, sans-serif; color: #4a2c2a; line-height: 1.5;">
    <h2 style="color: #e07a85; margin-bottom: 4px;">Cantinho Donuts</h2>
    <p>Olá, {{ $nome }}!</p>
    <p>Recebemos um pedido para criar uma nova senha no app. Digite este código na tela <strong>Redefinir senha</strong>:</p>

    <p style="font-size: 32px; font-weight: bold; letter-spacing: 8px; background: #fdf6ee; border: 2px solid #e07a85; border-radius: 10px; padding: 12px 20px; display: inline-block;">{{ $codigo }}</p>

    <p>O código vale por {{ $minutos }} minutos.</p>

    <p style="color: #777; font-size: 13px;">
        Se você não pediu para trocar a senha, ignore este e-mail. Sua senha atual continua a mesma.
    </p>
</body>
</html>
