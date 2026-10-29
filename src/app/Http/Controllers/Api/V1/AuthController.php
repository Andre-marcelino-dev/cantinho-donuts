<?php
 
namespace App\Http\Controllers\Api\V1;
 
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller
{
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