<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\MenuOption;
use App\Models\OrderItem;
use App\Models\Size;
use App\Models\Payment;
use App\Models\Price;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $cardapios = Menu::where('date', date('Y-m-d'))->get();
        $opcoesMenu = MenuOption::whereIn('menu_id', $cardapios->pluck('id'))->get();
        $tamanhos = Size::all();
        $pagamentos = Payment::all();
        $prices = Price::all();

        return view('pedidos.cardapiodia', compact('cardapios', 'opcoesMenu', 'tamanhos', 'pagamentos', 'prices'));
    }
    public function admindex()
    {
        $cardapios = Menu::where('date', date('Y-m-d'))->get();
        $opcoesMenu = MenuOption::whereIn('menu_id', $cardapios->pluck('id'))->get();
        $tamanhos = Size::all();
        $pagamentos = Payment::all();
        $prices = Price::all();

        return view('pedidos.admcardapiodia', compact('cardapios', 'opcoesMenu', 'tamanhos', 'pagamentos', 'prices'));
    }


    public function store(Request $request)
    {
        try {

            // Obter o usuário atualmente autenticado
            $user = Auth::user();

            // Verificar se o usuário não é um administrador
            if (!$user->is_admin) {
                // Verificar se o horário atual é depois das 9:30
                $deadline = Carbon::createFromTime(9, 30);
                $now = now();
                if ($now->greaterThanOrEqualTo($deadline)) {
                    // Se for depois das 9:30, retornar um erro
                    return response()->json(['message' => 'Pedidos só podem ser feitos até as 9:30 da manhã. Entre em contato com a Recepção'], 422);
                }
            }

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
            return response()->json([
                'message' => 'Pedido feito com sucesso! Verifique na aba "Meus Pedidos"'
            ], 200);

            //return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Registrar o erro no log
            Log::error($e->getMessage());

            // Retornar uma resposta JSON com o erro
            return response()->json(['success' => false, 'message' => 'Ocorreu um erro ao cadastrar o pedido. Por favor, tente novamente.'], 500);
                }
    }




    public function createWhatsAppMessage($restaurantId)
    {
        $restaurant = Restaurant::find($restaurantId);
        $orders = Order::whereHas('menu.restaurant', function ($query) use ($restaurantId) {
            $query->where('id', $restaurantId);
        })->get();

        $message = "Pedidos do Restaurante: {$restaurant->name}" . PHP_EOL . PHP_EOL;

        foreach ($orders as $order) {
            $message .= "Pedido ID: {$order->id}" . PHP_EOL;
            $message .= "Usuário: {$order->user->name}" . PHP_EOL;
            $message .= "Soda: {$order->soda}" . PHP_EOL;
            $message .= "Troco: {$order->change}" . PHP_EOL;
            $message .= "Observações: {$order->observations}" . PHP_EOL;
            $message .= "Tamanho: {$order->size->name}" . PHP_EOL;
            $message .= "Pagamento: {$order->payment->name}" . PHP_EOL . PHP_EOL;
        }

        $whatsAppUrl = 'https://api.whatsapp.com/send?text=' . urlencode($message);

        return redirect($whatsAppUrl);
    }



}
