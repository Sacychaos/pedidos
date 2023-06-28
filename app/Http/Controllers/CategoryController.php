<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $defaultCategories = ['Opções', 'Carnes', 'Acompanhamentos'];

        // Buscar as categorias existentes, ordenando-as de acordo com a lista de categorias padrão
        $categorias = Category::whereIn('name', $defaultCategories)
            ->orderByRaw("FIELD(name, '" . implode("','", $defaultCategories) . "')")
            ->get();

        // Verificar e criar as categorias padrão se não existirem
        foreach ($defaultCategories as $defaultCategory) {
            $category = Category::where('name', $defaultCategory)->first();

            if (!$category) {
                Category::create(['name' => $defaultCategory]);
            }
        }

        return view('/admin/categories.category', compact('categorias'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Category::all();
        return view('/admin/categories.category_create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::where('name', $request->input('name'))->first();

        if ($category) {
            return redirect()->route('categories.index')->with('error', 'Categoria já existe.');
        }

        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorias = Category::find($id);

        if (!$categorias) {
            return redirect()->route('categories.index')->with('error', 'Categoria não encontrada.');
        }

        $categorias->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso.');
    }
}