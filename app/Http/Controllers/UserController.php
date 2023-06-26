<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('usuarios.user', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectors = Sector::all();
        return view('usuarios.user_create', compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $sectors = Sector::all();
        return view('usuarios.user_edit', compact('user', 'sectors'));
    }

    /**
     * Update the specified resource in storage.
     */
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');


    }
}