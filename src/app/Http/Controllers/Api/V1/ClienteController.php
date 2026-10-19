<?php
 
namespace App\Http\Controllers\Api\V1;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 
class ClienteController extends Controller
{
    // GET /api/v1/cliente
    public function show(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user(), // senha_cliente já sai oculta pelo $hidden
        ]);
    }
 
    // PUT e PATCH /api/v1/cliente
    public function update(Request $request)
    {
        // "sometimes" = só valida se o campo vier (permite atualização parcial)
        $dados = $request->validate([
            'nome_cliente'        => 'sometimes|required|string|max:50',
            'data_nasc_cliente'   => 'sometimes|required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'endereco_cliente'    => 'sometimes|required|string|max:40',
            'numero_cliente'      => 'sometimes|required|string|max:6',
            'complemento_cliente' => 'sometimes|nullable|string|max:50',
            'bairro_cliente'      => 'sometimes|required|string|max:40',
            'cidade_cliente'      => 'sometimes|required|string|max:40',
            'uf_cliente'          => 'sometimes|required|string|size:2',
            'cep_cliente'         => 'sometimes|required|string|max:9',
            'telefone_cliente'    => 'sometimes|required|string|max:14', // limite da coluna
            'novidades_cliente'   => 'sometimes|required|in:SIM,NAO',     // aceita receber novidades e promoções
        ], [
            'data_nasc_cliente.date'            => 'Informe uma data de nascimento válida.',
            'data_nasc_cliente.after_or_equal'  => 'Informe uma data de nascimento válida.',
            'data_nasc_cliente.before_or_equal' => 'A data de nascimento não pode ser no futuro.',
        ]);
 
        $cliente = $request->user();
        $cliente->update($dados);
 
        return response()->json([
            'success' => true,
            'message' => 'Dados atualizados com sucesso.',
            'data' => $cliente->fresh(),
        ]);
    }
 
    // POST /api/v1/cliente/foto
    // Recebe a foto (campo "foto", multipart) e salva na mesma pasta do painel admin
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $cliente = $request->user();

        // Nome curto (a coluna foto_cliente aceita até 60 caracteres)
        $arquivo = $request->file('foto');
        $nomeArquivo = time() . '_cliente' . $cliente->id_cliente . '.' . $arquivo->extension();
        $arquivo->move(public_path('davilla/images/cliente'), $nomeArquivo);

        $cliente->foto_cliente = $nomeArquivo;
        $cliente->save();

        return response()->json([
            'success' => true,
            'message' => 'Foto atualizada com sucesso.',
            'data' => $cliente->fresh(),
        ]);
    }

    // PUT /api/v1/cliente/senha
    public function updateSenha(Request $request)
    {
        $dados = $request->validate([
            'senha_atual' => 'required|string',
            'nova_senha'  => 'required|string|min:8|confirmed|different:senha_atual',
        ]);
 
        $cliente = $request->user();
 
        if (!Hash::check($dados['senha_atual'], $cliente->senha_cliente)) {
            return response()->json([
                'success' => false,
                'message' => 'Senha atual incorreta.',
            ], 422);
        }
 
        $cliente->senha_cliente = Hash::make($dados['nova_senha']);
        $cliente->save();
 
        return response()->json([
            'success' => true,
            'message' => 'Senha atualizada com sucesso.',
        ]);
    }
}