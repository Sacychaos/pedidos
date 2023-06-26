<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuOption;
use App\Models\Option;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function index(Request $request)
{
    $restaurantes = Restaurant::all();
    $opcoes = Option::all();
    $categorias = Category::all();

    // Obter a data selecionada do campo de entrada
    $selectedDate = $request->input('selected_date', now()->toDateString());

    // Buscar os menus para a data selecionada com as informações do restaurante e das opções selecionadas
    $menus = Menu::with('restaurant', 'menuOptions.option')
        ->whereDate('date', $selectedDate)
        ->get();

    return view('admin.cardapio.cardapio', compact('menus', 'opcoes', 'categorias', 'restaurantes', 'selectedDate'));
}





    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    //
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $opcoesSelecionadas = $request->input('opcoes', []);
    $restauranteId = $request->input('restaurant');
    $dataAtual = $request->input('date');

    // Salvar o menu na tabela 'menus'
    $menu = new Menu();
    $menu->date = $dataAtual;
    $menu->restaurant_id = $restauranteId;
    $menu->save();

    // Salvar as relações entre o menu e as opções selecionadas na tabela 'menu_options'
    foreach ($opcoesSelecionadas as $opcaoId) {
        $menuOption = new MenuOption();
        $menuOption->menu_id = $menu->id;
        $menuOption->option_id = $opcaoId;
        $menuOption->save();
    }

    // Redirecionar de volta para a página anterior
    return back();

}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $menu = Menu::findOrFail($id);
    $menu->delete();

    return back()->with('success', 'Menu excluído com sucesso.');
}


}