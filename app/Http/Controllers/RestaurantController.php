<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurantes = Restaurant::all();
        return view('/admin/restaurante.restaurant', compact('restaurantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurantes = Restaurant::all();
        return view('/admin/restaurante.restaurant_create', compact('restaurantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'max:16',
        ]);

        Restaurant::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('restaurants.index')->with('success', 'Restaurante criado com sucesso.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $restaurantes = Restaurant::find($id);

        if (!$restaurantes) {
            return redirect()->route('restaurants.index')->with('error', 'Restaurante não encontrado.');
        }

        $restaurantes->delete();

        return redirect()->route('restaurants.index')->with('success', 'Restaurante excluído com sucesso.');
    }

    public function edit($id)
    {
        $restaurante = Restaurant::find($id);

        if (!$restaurante) {
            return redirect()->route('restaurants.index')->with('error', 'Restaurante não encontrado.');
        }

        return view('/admin/restaurante.restaurant_edit', compact('restaurante'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'max:16',
        ]);

        $restaurante = Restaurant::find($id);

        if (!$restaurante) {
            return redirect()->route('restaurants.index')->with('error', 'Restaurante não encontrado.');
        }

        $restaurante->name = $request->input('name');
        $restaurante->phone = $request->input('phone');
        $restaurante->save();

        return redirect()->route('restaurants.index')->with('success', 'Restaurante atualizado com sucesso.');
    }


}