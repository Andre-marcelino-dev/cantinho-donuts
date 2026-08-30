<?php
 
namespace App\Http\Controllers\admin;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
 
    public function autenticar(Request $request)
    {
 
        $request->validate([
            'email_usuario' => 'required|email',
            'senha_usuario' => 'required',
           
        ]);
 
        //Credenciais necessárias para o usuario/funcionario logar no sistema, verificando se o email e senha estão corretos e se o status do usuário é ATIVO
        $credenciais = [
            'email_usuario' => $request->email_usuario,
            'password'      => $request->senha_usuario,
            'status_usuario' => 'ATIVO',
        ];
 
        if (Auth::guard('admin')->attempt($credenciais)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dash');
        }
 
        return back()->withInput()->with('error', 'Email ou senha inválidos');
    }
 
    public function logout(Request $request ) {
   Auth::guard('admin')->logout();
   $request->session()->invalidate();
   $request->session()->regenerateToken();
   return redirect()->route('admin.login');

    }

public function perfil()
{
    $usuario = auth('admin')->user();
    return view('admin.dash.perfil', compact('usuario'));  // ← adicione .dash.
}




}
 
 