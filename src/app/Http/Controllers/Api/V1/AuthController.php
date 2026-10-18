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
        $nomeToken = $dados['device_name'] ?? 'app-davilla';
 
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