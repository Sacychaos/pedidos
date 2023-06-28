@extends('admin.admin')

@section('content')
<div class="card">
    <div class="card-header bg-light text-center">
        <h6 class="m-0 font-weight-bold text-primary">Meus Pedidos</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('pedidos.index') }}">
            @csrf
            <div class="form-group">
                <label for="data">Escolha a Data:</label>
                <input type="date" name="data" id="data" class="form-control" required value="{{ date('Y-m-d') }}">

            </div>
            <button type="submit" class="btn btn-primary mb-2 float-right">Buscar Pedidos</button>
        </form>


        @if ($pedidos->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Restaurante</th>
                        <th>Opções</th>
                        <th>Carnes</th>
                        <th>Acompanhamentos</th>
                        <th>Tamanho</th>
                        <th>Pagamento</th>
                        <th>Refrigerante</th>
                        <th>Troco Para</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->user->name }}</td>
                        <td>{{ $pedido->created_at->format('d/m/Y H:i:s') }}</td>
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

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>Nenhum pedido feito.</p>
        @endif
    </div>
</div>
@endsection