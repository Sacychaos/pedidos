<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $sectors = Sector::all();
        return view('usuarios.user_edit_password', compact('user', 'sectors'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('orders.index')->with('message', 'Senha atualizada com sucesso');
    }
}