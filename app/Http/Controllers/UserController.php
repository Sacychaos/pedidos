<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();

        // Aplicar filtro de setor, se selecionado
        if ($request->filled('sector')) {
            $sectorId = $request->input('sector');
            $query->where('sector_id', $sectorId);
        }

        // Aplicar filtro de nome, se preenchido
        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where('name', 'like', '%' . $name . '%');
        }

        // Ordenar por setor, se selecionado
        if ($request->filled('sort')) {
            $sortDirection = $request->input('sort');
            if ($request->input('sort') === 'asc') {
                $query->orderBy('name', 'asc');
            } elseif ($request->input('sort') === 'desc') {
                $query->orderBy('name', 'desc');
            }
        }

        $users = $query->get();
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