<?php
 
namespace App\Http\Controllers\Api\V1;
 
use App\Http\Controllers\Controller;
use App\Mail\CodigoRedefinirSenha;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    // Validade do código de redefinição de senha e tentativas erradas permitidas
    private const MINUTOS_CODIGO = 30;
    private const TENTATIVAS_CODIGO = 5;

    public function login(Request $request)
    {
        // 1. Validar e-mail e senha
        $dados = $request->validate([
            'email'       => 'required|email',
            'senha'       => 'required|string',
            'device_name' => 'nullable|string|max:100',
        ]);
 
        // 2. Localizar o cliente pelo e-mail
        $cliente = Cliente::where('email_cliente', $dados['email'])->first();
 
        // 3. Comparar a senha com o hash
        if (!$cliente || !Hash::check($dados['senha'], $cliente->senha_cliente)) {
            return response()->json([
                'success' => false,
                'message' => 'E-mail ou senha inválidos.',
            ], 401);
        }
 
        // 4. Confirmar que está ATIVO
        if ($cliente->status_cliente !== 'ATIVO') {
            return response()->json([
                'success' => false,
                'message' => 'Cliente inativo.',
            ], 403);
        }
 
        // 5. Gerar o token
        $nomeToken = $dados['device_name'] ?? 'app-donuts';
 
        $token = $cliente
            ->createToken($nomeToken)
            ->plainTextToken;
 
        // 6. Retornar token + dados básicos
        return response()->json([
            'success' => true,
            'message' => 'Login realizado com sucesso.',
            'data' => [
                'token' => $token,
                'cliente' => [
                    'id_cliente'       => $cliente->id_cliente,
                    'nome_cliente'     => $cliente->nome_cliente,
                    'email_cliente'    => $cliente->email_cliente,
                    'telefone_cliente' => $cliente->telefone_cliente,
                ],
            ],
        ]);
    }
 
    public function cadastro(Request $request)
    {
        // 1. Validar os dados da tela Criar Conta
        $dados = $request->validate([
            'nome'        => 'required|string|max:50',
            'email'       => 'required|email|max:80|unique:tbl_clientes,email_cliente',
            'telefone'    => 'required|string|max:14',
            'senha'       => 'required|string|min:6|confirmed',
            'device_name' => 'nullable|string|max:100',
        ], [
            'nome.required'     => 'Informe o nome.',
            'email.required'    => 'Informe o e-mail.',
            'email.email'       => 'Informe um e-mail válido.',
            'email.unique'      => 'Este e-mail já está cadastrado. Faça login.',
            'telefone.required' => 'Informe o telefone.',
            'telefone.max'      => 'Telefone muito longo.',
            'senha.required'    => 'Informe a senha.',
            'senha.min'         => 'A senha precisa ter pelo menos 6 caracteres.',
            'senha.confirmed'   => 'As senhas não conferem.',
        ]);

        // 2. Criar o cliente (CPF, nascimento e endereço ficam para o perfil)
        $cliente = Cliente::create([
            'nome_cliente'      => trim($dados['nome']),
            'tipo_cliente'      => 'PF',
            'email_cliente'     => $dados['email'],
            'telefone_cliente'  => $dados['telefone'],
            'senha_cliente'     => Hash::make($dados['senha']),
            'status_cliente'    => 'ATIVO',
            'novidades_cliente' => 'NAO',
        ]);

        // 3. Gerar o token para o cliente já entrar logado
        $token = $cliente
            ->createToken($dados['device_name'] ?? 'app-donuts')
            ->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Conta criada com sucesso.',
            'data' => [
                'token' => $token,
                'cliente' => [
                    'id_cliente'       => $cliente->id_cliente,
                    'nome_cliente'     => $cliente->nome_cliente,
                    'email_cliente'    => $cliente->email_cliente,
                    'telefone_cliente' => $cliente->telefone_cliente,
                ],
            ],
        ], 201);
    }

    public function esqueciSenha(Request $request)
    {
        $dados = $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email'    => 'Informe um e-mail válido.',
        ]);

        // A resposta é sempre a mesma, para não revelar quais e-mails têm conta
        $resposta = response()->json([
            'success' => true,
            'message' => 'Se este e-mail estiver cadastrado, você vai receber um código para criar uma nova senha.',
        ]);

        $cliente = Cliente::where('email_cliente', $dados['email'])->first();
        if (!$cliente || $cliente->status_cliente !== 'ATIVO') {
            return $resposta;
        }

        // Código de 6 dígitos; no banco fica só o hash
        $codigo = (string) random_int(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $cliente->email_cliente],
            ['token' => Hash::make($codigo), 'created_at' => now()]
        );
        RateLimiter::clear($this->chaveTentativas($cliente->email_cliente));

        try {
            Mail::to($cliente->email_cliente)->send(
                new CodigoRedefinirSenha($cliente->nome_cliente, $codigo, self::MINUTOS_CODIGO)
            );
        } catch (\Throwable $erro) {
            Log::error('Falha ao enviar o código de redefinir senha: ' . $erro->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Não foi possível enviar o e-mail agora. Tente de novo em alguns minutos.',
            ], 503);
        }

        return $resposta;
    }

    public function redefinirSenha(Request $request)
    {
        $dados = $request->validate([
            'email'  => 'required|email',
            'codigo' => 'required|digits:6',
            'senha'  => 'required|string|min:6|confirmed',
        ], [
            'email.required'  => 'Informe o e-mail.',
            'email.email'     => 'Informe um e-mail válido.',
            'codigo.required' => 'Informe o código que chegou no e-mail.',
            'codigo.digits'   => 'O código tem 6 números.',
            'senha.required'  => 'Informe a nova senha.',
            'senha.min'       => 'A senha precisa ter pelo menos 6 caracteres.',
            'senha.confirmed' => 'As senhas não conferem.',
        ]);

        $invalido = response()->json([
            'success' => false,
            'message' => 'Código inválido ou vencido. Peça um novo código.',
        ], 422);

        $registro = DB::table('password_reset_tokens')->where('email', $dados['email'])->first();
        if (!$registro) {
            return $invalido;
        }

        // Código vencido ou com tentativas erradas demais: apaga e pede outro
        $chave = $this->chaveTentativas($dados['email']);
        $vencido = now()->diffInMinutes(Carbon::parse($registro->created_at), true) > self::MINUTOS_CODIGO;
        if ($vencido || RateLimiter::tooManyAttempts($chave, self::TENTATIVAS_CODIGO)) {
            DB::table('password_reset_tokens')->where('email', $dados['email'])->delete();
            return $invalido;
        }

        if (!Hash::check($dados['codigo'], $registro->token)) {
            RateLimiter::hit($chave, self::MINUTOS_CODIGO * 60);
            return response()->json([
                'success' => false,
                'message' => 'Código incorreto. Confira o e-mail e tente de novo.',
            ], 422);
        }

        $cliente = Cliente::where('email_cliente', $dados['email'])->first();
        if (!$cliente) {
            return $invalido;
        }

        $cliente->senha_cliente = Hash::make($dados['senha']);
        $cliente->save();

        // Código usado e logins antigos encerrados (entra de novo com a senha nova)
        DB::table('password_reset_tokens')->where('email', $dados['email'])->delete();
        RateLimiter::clear($chave);
        $cliente->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Senha alterada! Faça login com a nova senha.',
        ]);
    }

    private function chaveTentativas(string $email): string
    {
        return 'redefinir-senha:' . mb_strtolower($email);
    }

    public function logout(Request $request)
    {
        // Apaga só o token usado nesta requisição
        $request->user()->currentAccessToken()->delete();
 
        return response()->json([
            'success' => true,
            'message' => 'Logout realizado com sucesso.',
        ]);
    }
}