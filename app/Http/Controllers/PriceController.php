<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Restaurant;
use App\Models\Size;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $restaurantes = Restaurant::all();
        $tamanhos = Size::all();
        $prices = Price::all();
        return view('admin/prices.prices', compact('restaurantes', 'tamanhos', 'prices'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required',
            'restaurante_id' => 'required|exists:restaurants,id',
            'tamanho_id' => 'required|exists:sizes,id',
        ]);

        Price::create([
            'price' => $request->input('price'),
            'restaurant_id' => $request->input('restaurante_id'),
            'size_id' => $request->input('tamanho_id'),
        ]);

        return redirect()->route('prices.index')->with('success', 'Preço criado com sucesso.');
    }

    public function show(Price $price)
    {
        //
    }

    public function edit(Price $price)
    {
        $restaurantes = Restaurant::all();
        $tamanhos = Size::all();


        return view('admin.prices.prices_edit', compact('restaurantes', 'tamanhos', 'price'));
    }

    public function update(Request $request, Price $price)
    {
        $request->validate([
            'price' => 'required',
            'restaurante_id' => 'required|exists:restaurants,id',
            'tamanho_id' => 'required|exists:sizes,id',
        ]);

        $price->update([
            'price' => $request->input('price'),
            'restaurant_id' => $request->input('restaurante_id'),
            'size_id' => $request->input('tamanho_id'),
        ]);

        return redirect()->route('prices.index')->with('success', 'Preço atualizado com sucesso.');
    }

    public function destroy(Price $price)
    {
        $price->delete();

        return redirect()->route('prices.index')->with('success', 'Preço excluído com sucesso.');
    }
}