<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


// "Meu Perfil": o usuário logado no painel edita os próprios dados
class PerfilController extends Controller
{
    public function index()
    {
        $usuario = auth('admin')->user();

        return view('admin.perfil.index', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = auth('admin')->user();

        $dados = $request->validate([
            'nome_usuario'  => 'required|string|max:50',
            'email_usuario' => ['required', 'email', 'max:80', Rule::unique('tbl_usuarios', 'email_usuario')->ignore($usuario->id_usuario, 'id_usuario')],
            'foto_usuario'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nome_usuario.required'  => 'Informe o seu nome.',
            'email_usuario.required' => 'Informe o seu e-mail.',
            'email_usuario.email'    => 'Informe um e-mail válido.',
            'email_usuario.unique'   => 'Esse e-mail já é usado por outro usuário.',
            'foto_usuario.image'     => 'A foto precisa ser uma imagem.',
            'foto_usuario.max'       => 'A foto pode ter no máximo 2 MB.',
        ]);

        $usuario->nome_usuario = trim($dados['nome_usuario']);
        $usuario->email_usuario = trim($dados['email_usuario']);

        // Mesma pasta e formato da tela de Usuários ("usuario/arquivo").
        // foto_usuario aceita só 30 caracteres, por isso o nome é curto: "usuario/u4_k3j9x1.jpg"
        $fotoAntiga = null;
        if ($request->hasFile('foto_usuario')) {
            $fotoAntiga = $usuario->foto_usuario;
            $arquivo = $request->file('foto_usuario');
            $nome = 'u' . $usuario->id_usuario . '_' . base_convert((string) time(), 10, 36) . '.' . $arquivo->extension();
            $arquivo->move(public_path('dash/assets/img/usuario'), $nome);
            $usuario->foto_usuario = 'usuario/' . $nome;
        }

        $usuario->save();

        // A foto antiga só é apagada depois que o banco salvou a nova
        if ($fotoAntiga && $fotoAntiga !== 'default.png' && $fotoAntiga !== $usuario->foto_usuario
            && is_file(public_path('dash/assets/img/' . $fotoAntiga))) {
            @unlink(public_path('dash/assets/img/' . $fotoAntiga));
        }

        return redirect()->route('admin.perfil')->with('sucesso', 'Seus dados foram atualizados.');
    }

    public function updateSenha(Request $request)
    {
        $usuario = auth('admin')->user();

        $dados = $request->validate([
            'senha_atual' => 'required|string',
            'nova_senha'  => 'required|string|min:8|confirmed|different:senha_atual',
        ], [
            'senha_atual.required' => 'Informe a sua senha atual.',
            'nova_senha.required'  => 'Informe a nova senha.',
            'nova_senha.min'       => 'A nova senha precisa ter pelo menos 8 caracteres.',
            'nova_senha.confirmed' => 'A confirmação não é igual à nova senha.',
            'nova_senha.different' => 'A nova senha precisa ser diferente da atual.',
        ]);

        if (!Hash::check($dados['senha_atual'], $usuario->senha_usuario)) {
            return back()->withErrors(['senha_atual' => 'A senha atual está incorreta.']);
        }

        $usuario->senha_usuario = Hash::make($dados['nova_senha']);
        $usuario->save();

        return redirect()->route('admin.perfil')->with('sucesso', 'Senha alterada com sucesso.');
    }
}
