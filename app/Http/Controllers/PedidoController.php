<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $dataPedido = $request->input('data');

        // Verificar se a data foi fornecida, caso contrário, usar a data atual
        $data = $dataPedido ? $dataPedido : today();

        // Obter os pedidos da data selecionada
        $pedidos = Order::whereDate('created_at', $data)->get();

        // Definir a data selecionada como valor padrão para o campo de data
        $selectedDate = $dataPedido;

        return view('admin.cardapio.pedidos', compact('pedidos', 'selectedDate'));
    }



    public function meuspedidos(Request $request)
    {
        // Obter o ID do usuário logado
        $userId = Auth::id();

        // Obter a data do pedido a partir da requisição
        $dataPedido = $request->input('data', today());

        // Obter os pedidos do usuário logado da data selecionada
        $pedidos = Order::where('user_id', $userId)
                        ->whereDate('created_at', $dataPedido)
                        ->get();

        // Definir a data selecionada como valor padrão para o campo de data
        $selectedDate = $dataPedido;

        return view('admin.cardapio.meupedido', compact('pedidos', 'selectedDate'));
    }


    public function meuspedidosadm(Request $request)
    {
        // Obter o ID do usuário logado
        $userId = Auth::id();

        // Obter a data do pedido a partir da requisição
        $dataPedido = $request->input('data', today());

        // Obter os pedidos do usuário logado da data selecionada
        $pedidos = Order::where('user_id', $userId)
                        ->whereDate('created_at', $dataPedido)
                        ->get();

        // Definir a data selecionada como valor padrão para o campo de data
        $selectedDate = $dataPedido;

        return view('admin.cardapio.admmeupedido', compact('pedidos', 'selectedDate'));
    }

    public function destroy($id)
    {
        // Excluir o pedido pelo ID
        Order::destroy($id);

        // Redirecionar de volta para a lista de pedidos com uma mensagem de sucesso
        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso.');
    }


}
