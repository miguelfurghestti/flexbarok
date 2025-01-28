<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
