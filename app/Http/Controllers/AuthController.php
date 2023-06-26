<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida

            // Verificar se o usuário é administrador
            $user = Auth::user();
            if ($user->is_admin) {
                return redirect()->intended('/admin')->with('success', 'Login realizado com sucesso como administrador.');
            }

            return redirect()->intended('orders')->with('success', 'Login realizado com sucesso.');
        }

        // Autenticação falhou
        return redirect()->intended('login')->with('error', 'Login não efetuado. Verifique suas credenciais');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::logout();

        return redirect('/login');
    }


}