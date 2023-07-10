<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::all();
        $sectors = Sector::all();

        return view('usuarios.user', ['users' => $users, 'sectors' => $sectors]);
    }





    public function create()
    {
        $sectors = Sector::all();
        return view('usuarios.user_create', compact('sectors'));
    }


    public function store(Request $request)
    {
    $isAdmin = $request->has('is_admin') ? true : false;

    $created = User::create([
        'name' => $request->input('name'),
        'username' => $request->input('username'),
        'password' => password_hash($request->input('password'), PASSWORD_DEFAULT),
        'sector_id' => $request->input('sector_id'),
        'is_admin' => $isAdmin,
    ]);

    if ($created) {
        return redirect()->back()->with('message', 'Criado');
    }

    return redirect()->back()->with('message', 'Erro ao Criar');
    }


    public function edit(User $user)
    {
        $sectors = Sector::all();
        return view('usuarios.user_edit', compact('user', 'sectors'));
    }


    public function update(Request $request, User $user)
    {
    $data = $request->except(['_token', '_method']);

    if (empty($request->input('password'))) {
        unset($data['password']);
    } else {
        $data['password'] = password_hash($request->input('password'), PASSWORD_DEFAULT);
    }

    $data['is_admin'] = $request->has('is_admin') ? true : false;

    $updated = $user->update($data);

    if ($updated) {
        return redirect()->back()->with('message', 'Atualizado');
    }

    return redirect()->back()->with('message', 'Erro ao Atualizar');
    }



    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');


    }
}