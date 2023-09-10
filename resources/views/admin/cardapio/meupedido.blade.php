@extends('admin.master')

@section('content')
<div class="card mx-4">
    <div class="card-header bg-light text-center">
        <h6 class="m-0 font-weight-bold text-primary">Meus Pedidos</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('meuspedidos') }}">
            <div class="form-group">
                <label for="data">Procure por Data:</label>
                <div class="input-group">
                    <input type="date" name="data" id="data" class="form-control col-md-3" required
                        value="{{ old('data', $selectedDate) }}">
                </div>
            </div>
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
                        <th>Ações</th>
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
                        <td>
                            <!-- Botão de Exclusão -->
                            <form action="{{ route('destroyorder', $pedido->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
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
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecione o campo de data
    var dataInput = document.querySelector('#data');

    // Obtenha o valor selecionado inicialmente (data atual)
    var selectedDate = dataInput.value;

    // Atribua o valor selecionado como atributo "value" do campo de data
    dataInput.setAttribute('value', selectedDate);

    // Adicione um ouvinte de evento de mudança ao campo de data
    dataInput.addEventListener('change', function() {
        // Submeta o formulário quando a data for alterada
        this.form.submit();
    });
});
</script>

@endsection
