<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tamanhos = Size::all();
        return view('/admin/sizes.size', compact('tamanhos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tamanhos = Size::all();
        return view('admin.sizes.size_create', compact('tamanhos'));
    }

    /**
     * Store a newly created resource in storage.
     */
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $size = Size::find($id);

        if (!$size) {
            return redirect()->route('sizes.index')->with('error', 'Tamanho não encontrado.');
        }

        $size->delete();

        return redirect()->route('sizes.index')->with('success', 'Tamanho excluído com sucesso.');
    }
}