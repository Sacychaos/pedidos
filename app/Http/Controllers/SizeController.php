<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $tamanhos = Size::all();
        return view('admin.sizes.size', compact('tamanhos'));
    }

    public function create()
    {
        return view('admin.sizes.size_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Size::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('sizes.index')->with('success', 'Tamanho criado com sucesso.');
    }

    public function edit($id)
    {
        $tamanho = Size::find($id);

        if (!$tamanho) {
            return redirect()->route('sizes.index')->with('error', 'Tamanho não encontrado.');
        }

        return view('admin.sizes.size_edit', compact('tamanho'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $tamanho = Size::find($id);

        if (!$tamanho) {
            return redirect()->route('sizes.index')->with('error', 'Tamanho não encontrado.');
        }

        $tamanho->name = $request->input('name');
        $tamanho->save();

        return redirect()->route('sizes.index')->with('success', 'Tamanho atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $tamanho = Size::find($id);

        if (!$tamanho) {
            return redirect()->route('sizes.index')->with('error', 'Tamanho não encontrado.');
        }

        $tamanho->delete();

        return redirect()->route('sizes.index')->with('success', 'Tamanho excluído com sucesso.');
    }
}