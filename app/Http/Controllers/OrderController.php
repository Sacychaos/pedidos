<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\MenuOption;
use App\Models\OrderItem;
use App\Models\Size;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $cardapios = Menu::where('date', date('Y-m-d'))->get();
        $opcoesMenu = MenuOption::whereIn('menu_id', $cardapios->pluck('id'))->get();
        $tamanhos = Size::all();
        $pagamentos = Payment::all();

        return view('pedidos.cardapiodia', compact('cardapios', 'opcoesMenu', 'tamanhos', 'pagamentos'));
    }
    public function admindex()
    {
        $cardapios = Menu::where('date', date('Y-m-d'))->get();
        $opcoesMenu = MenuOption::whereIn('menu_id', $cardapios->pluck('id'))->get();
        $tamanhos = Size::all();
        $pagamentos = Payment::all();

        return view('pedidos.admcardapiodia', compact('cardapios', 'opcoesMenu', 'tamanhos', 'pagamentos'));
    }


    public function store(Request $request)
    {
        try {

            // Obter o ID do usuário logado
            $userId = Auth::id();

            // Validar os dados do formulário
            $validatedData = $request->validate([
                'tamanho_' . $request->input('menu_id') => 'required',
                'f_pagamento.' . $request->input('menu_id') => 'required',
            ]);



            // Criar o pedido na tabela "orders"
            $order = new Order();
            $order->soda = $request->input('f_refrigerante.' . $request->input('menu_id'));
            $order->change = $request->input('f_troco.' . $request->input('menu_id'));
            $order->observations = $request->input('f_obs.' . $request->input('menu_id'));
            $order->user_id = $userId;
            // Defina os demais campos do pedido de acordo com o seu formulário
            $order->menu_id = $request->input('menu_id');
            $order->size_id = $request->input('tamanho_' . $order->menu_id);
            $order->payment_id = $request->input('f_pagamento.' . $request->input('menu_id'));
            $order->save();




            // Criar os itens do pedido na tabela "order_items"
            $menuId = $request->input('menu_id');

            // Obter as opções de menu selecionadas para o cardápio atual
            $opcoes = $request->input('opcoes.' . $menuId, []);
            $carnes = $request->input('carnes.' . $menuId, []);
            $acompanhamentos = $request->input('acompanhamentos.' . $menuId, []);

            // Criar um registro na tabela "order_items" para cada opção selecionada
            foreach ($opcoes as $opcaoId) {
                $menuOption = MenuOption::where('option_id', $opcaoId)->where('menu_id', $menuId)->first();

                if ($menuOption) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->menu_option_id = $menuOption->id;
                    $orderItem->save();
                }
            }

            // Criar um registro na tabela "order_items" para cada carne selecionada
            foreach ($carnes as $carneId) {
                $menuOption = MenuOption::where('option_id', $carneId)->where('menu_id', $menuId)->first();

                if ($menuOption) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->menu_option_id = $menuOption->id;
                    $orderItem->save();
                }
            }

            // Criar um registro na tabela "order_items" para cada acompanhamento selecionado
            foreach ($acompanhamentos as $acompanhamentoId) {
                $menuOption = MenuOption::where('option_id', $acompanhamentoId)->where('menu_id', $menuId)->first();

                if ($menuOption) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->menu_option_id = $menuOption->id;
                    $orderItem->save();
                }
            }



            // Retorna uma resposta de sucesso
            return response()->json(['message' => 'Pedido feito com sucesso!'], 200);

            //return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Registrar o erro no log
            Log::error($e->getMessage());

            // Retornar uma resposta JSON com o erro
            return response()->json(['success' => false, 'message' => 'Ocorreu um erro ao cadastrar o pedido. Por favor, tente novamente.'], 500);
                }
    }


}