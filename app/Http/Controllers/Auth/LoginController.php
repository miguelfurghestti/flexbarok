<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Redireciona o usuário após a autenticação.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */

    protected function authenticated(Request $request, $user)
    {
        if ($user->level == 999) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('shop.dashboard');
    }

    public function login(Request $request)
    {
        // Validação das credenciais
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Tentativa de autenticação
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verifica o nível de acesso e redireciona
            if ($user->level == 999) {
                return redirect()->route('admin.dashboard'); // Admin
            } elseif ($user->level == 1) {
                return redirect()->route('shop.dashboard'); // Shop
            }

            // Caso o level não esteja mapeado
            Auth::logout();
            return redirect()->route('login')->withErrors(['level' => 'Acesso não autorizado.']);
        }

        // Retorna erro se as credenciais não forem válidas
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function loginForm()
    {
        return view('login.index'); // O caminho da view do formulário de login
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
