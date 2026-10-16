<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Lista todos os usuários.
     */
    public function index()
    {
        $usuarios = Usuario::orderBy('nome_usuario')->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create()
    {
        $perfis = Usuario::perfis();

        return view('admin.usuarios.create', compact('perfis'));
    }

    /**
     * Salva um novo usuário.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome_usuario'   => 'required|string|max:50',
            'email_usuario'  => 'required|email|max:80|unique:tbl_usuarios,email_usuario',
            'senha_usuario'  => 'required|string|min:6|confirmed',
            'perfil_usuario' => 'required|in:' . implode(',', Usuario::perfis()),
            'status_usuario' => 'required|in:ATIVO,INATIVO',
            'foto_usuario'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dados = $request->only([
            'nome_usuario',
            'email_usuario',
            'perfil_usuario',
            'status_usuario',
        ]);

        $dados['senha_usuario'] = Hash::make($request->senha_usuario);

        // Upload da foto
        if ($request->hasFile('foto_usuario')) {
            $foto = $request->file('foto_usuario');
            // foto_usuario aceita só 30 caracteres: nome curto em vez do nome da pessoa
            $nome = 'u_' . base_convert((string) time(), 10, 36) . '.' . $foto->extension();
            $foto->move(public_path('dash/assets/img/usuario'), $nome);
            $dados['foto_usuario'] = 'usuario/' . $nome;
        } else {
            $dados['foto_usuario'] = 'default.png';
        }

        Usuario::create($dados);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário criado com sucesso!');
    }


/**
     * Exibe o perfil de um usuário.
     */
    public function show(Usuario $usuario)
    {
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Usuario $usuario)
    {
        $perfis = Usuario::perfis();

        return view('admin.usuarios.edit', compact('usuario', 'perfis'));
    }

    /**
     * Atualiza um usuário existente.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nome_usuario'   => 'required|string|max:50',
            'email_usuario'  => 'required|email|max:80|unique:tbl_usuarios,email_usuario,' . $usuario->id_usuario . ',id_usuario',
            'senha_usuario'  => 'nullable|string|min:6|confirmed',
            'perfil_usuario' => 'required|in:' . implode(',', Usuario::perfis()),
            'status_usuario' => 'required|in:ATIVO,INATIVO',
            'foto_usuario'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dados = $request->only([
            'nome_usuario',
            'email_usuario',
            'perfil_usuario',
            'status_usuario',
        ]);

        // Só atualiza a senha se informada
        if ($request->filled('senha_usuario')) {
            $dados['senha_usuario'] = Hash::make($request->senha_usuario);
        }

        // Upload da nova foto
        $fotoAtual = null;
        if ($request->hasFile('foto_usuario')) {
            $fotoAtual = $usuario->foto_usuario;

            $foto = $request->file('foto_usuario');
            // foto_usuario aceita só 30 caracteres: nome curto em vez do nome da pessoa
            $nome = 'u' . $usuario->id_usuario . '_' . base_convert((string) time(), 10, 36) . '.' . $foto->extension();
            $foto->move(public_path('dash/assets/img/usuario'), $nome);
            $dados['foto_usuario'] = 'usuario/' . $nome;
        }

        $usuario->update($dados);

        // Remove a foto antiga (exceto default) só depois que o banco salvou a nova
        if ($fotoAtual && $fotoAtual !== 'default.png' && $fotoAtual !== $usuario->foto_usuario) {
            $caminho = public_path('dash/assets/img/' . $fotoAtual);
            if (file_exists($caminho)) {
                unlink($caminho);
            }
        }

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove um usuário.
     */
    public function destroy(Usuario $usuario)
    {
        // Não permite excluir o próprio usuário logado
        if (session('usuario_id') == $usuario->id_usuario) {
            return redirect()->route('admin.usuarios.index')
                ->with('error', 'Você não pode excluir seu próprio usuário.');
        }

        // Remove foto (exceto default)
        if ($usuario->foto_usuario && $usuario->foto_usuario !== 'default.png') {
            $caminho = public_path('dash/assets/img/' . $usuario->foto_usuario);
            if (file_exists($caminho)) {
                unlink($caminho);
            }
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário removido com sucesso!');
    }
}
