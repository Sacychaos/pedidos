<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function sendOrders(Request $request)
    {
        $restaurantId = $request->restaurantId;

        // Obter pedidos do restaurante especificado
        $orders = Order::whereHas('menu.restaurant', function ($query) use ($restaurantId) {
            $query->where('id', $restaurantId);
        })->get();

        // Gerar a mensagem de texto com os detalhes do pedido
        $message = '';
        foreach ($orders as $order) {
            // Aqui você pode formatar a mensagem como preferir
            $message .= "Pedido: " . $order->id . "\n";
            $message .= "Usuário: " . $order->user->name . "\n";
            $message .= "Detalhes: " . $order->details . "\n\n";  // Assumindo que há uma coluna 'details' na tabela 'orders'
        }

        // Formatar a mensagem em uma URL do WhatsApp
        $whatsAppNumber = $orders->first()->menu->restaurant->whatsappNumber;
        $whatsAppUrl = "https://wa.me/$whatsAppNumber?text=" . urlencode($message);

        // Retornar a URL do WhatsApp
        return response()->json(['whatsAppUrl' => $whatsAppUrl]);
    }
}