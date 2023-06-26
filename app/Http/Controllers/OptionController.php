<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        $opcoes = Option::all();
        $categorias = Category::all();
        return view('/admin/option.option', compact('opcoes', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $opcoes = Option::all();
        $categorias = Category::all();
        return view('/admin/option.option_create', compact('opcoes', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Option::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('options.index')->with('success', 'Opção criada com sucesso.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $opcoes = Option::find($id);

        if (!$opcoes) {
            return redirect()->route('options.index')->with('error', 'Opção não encontrada.');
        }

        $opcoes->delete();

        return redirect()->route('options.index')->with('success', 'Opção excluída com sucesso.');
    }
}