@extends('admin.admin')

@section('content')
<div class="card mx-4">
    <div class="card-header bg-light text-center">
        <h6 class="m-0 font-weight-bold text-primary">Pedidos do Dia</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('pedidos.index') }}">
            <div class="form-group">
                <label for="data">Procure por Data:</label>
                <input type="date" name="data" id="data" class="form-control" required
                    value="{{ old('data', date('Y-m-d')) }}">
            </div>
        </form>

        @if ($pedidos->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Usuário</th>
                        <th>Setor</th>
                        <th>Restaurante</th>
                        <th>Opções</th>
                        <th>Carnes</th>
                        <th>Acompanhamentos</th>
                        <th>Tamanho</th>
                        <th>Pagamento</th>
                        <th>Refrigerante</th>
                        <th>Troco Para</th>
                        <th>Observações</th>
                        <th>Ações</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($pedido->date)->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $pedido->user->name }}</td>
                        <td>{{ $pedido->user->sector->name }}</td>
                        <td>{{ $pedido->menu->restaurant->name }}</td>
                        <td>
                            {{
                                implode(', ', array_map(function($orderItem) {
                                    return $orderItem->menuOption->option->name;
                                }, array_filter($pedido->orderItems->all(), function($orderItem) {
                                    return $orderItem->menuOption->option->category->name == 'Opções';
                                })))
                            }}
                        </td>
                        <td>
                            {{
                                implode(', ', array_map(function($orderItem) {
                                    return $orderItem->menuOption->option->name;
                                }, array_filter($pedido->orderItems->all(), function($orderItem) {
                                    return $orderItem->menuOption->option->category->name == 'Carnes';
                                })))
                            }}
                        </td>
                        <td>
                            {{
                                implode(', ', array_map(function($orderItem) {
                                    return $orderItem->menuOption->option->name;
                                }, array_filter($pedido->orderItems->all(), function($orderItem) {
                                    return $orderItem->menuOption->option->category->name == 'Acompanhamentos';
                                })))
                            }}
                        </td>
                        <td>{{ $pedido->size->name }}</td>
                        <td>{{ $pedido->payment->name }}</td>
                        <td>{{ $pedido->soda }}</td>
                        <td>{{ $pedido->change }}</td>
                        <td>{{ $pedido->observations }}</td>
                        <td>
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>Nenhum pedido feito neste dia.</p>
        @endif

        <!-- Adicione os botões do WhatsApp para cada restaurante -->
        @foreach ($pedidos->groupBy('menu.restaurant.id') as $restaurantOrders)
        @php
        $restaurant = $restaurantOrders->first()->menu->restaurant;
        $whatsAppNumber = preg_replace('/\D/', '', $restaurant->phone);
        $whatsAppMessage = '';
        foreach ($restaurantOrders as $order) {
        $whatsAppMessage .= "Nome: " . $order->user->name . PHP_EOL;

        // Acessar as opções selecionadas do pedido
        $selectedOptions = $order->orderItems->pluck('menuOption.option.name')->toArray();
        if (!empty($selectedOptions)) {
        $whatsAppMessage .= "Opções: " . implode(', ', $selectedOptions) . PHP_EOL;
        }

        if (!empty($order->size->name)) {
        $whatsAppMessage .= "Tamanho: " . $order->size->name . PHP_EOL;
        }

        if (!empty($order->payment->name)) {
        $whatsAppMessage .= "Pagamento: " . $order->payment->name . PHP_EOL;
        }

        if (!empty($order->soda)) {
        $whatsAppMessage .= "Refrigerante: " . $order->soda . PHP_EOL;
        }

        if (!empty($order->change)) {
        $whatsAppMessage .= "Troco Para: " . $order->change . PHP_EOL;
        }

        if (!empty($order->observations)) {
        $whatsAppMessage .= "Observações: " . $order->observations . PHP_EOL;
        }

        $whatsAppMessage .= PHP_EOL;
        }
        $whatsAppUrl = 'https://wa.me/' . $whatsAppNumber . '?text=' . urlencode($whatsAppMessage);
        @endphp
        <a href="{{ $whatsAppUrl }}" class="btn btn-sm btn-success mb-2 float-center left" target="_blank"><i
                class="bi bi-whatsapp"></i> {{ $restaurant->name }}</a>
        @endforeach





    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecione o campo de data
    var dataInput = document.querySelector('#data');

    // Adicione um ouvinte de evento de mudança ao campo de data
    dataInput.addEventListener('change', function() {
        // Submeta o formulário quando a data for alterada
        this.form.submit();
    });
});
</script>

@endsection