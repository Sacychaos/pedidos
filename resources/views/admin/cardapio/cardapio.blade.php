@extends('admin.admin')

@section('content')
<h1>Cadastrar Pedidos do Dia</h1>

<div class="card">

    <div class="card-body" id="pedidoform">
        <form action="{{ route('menus.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="restaurant">Restaurante</label>
                <select class="form-control" id="restaurant" name="restaurant">
                    @foreach($restaurantes as $restaurante)
                    <option value="{{ $restaurante->id }}">{{ $restaurante->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date">Data</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ now()->toDateString() }}">
            </div>

            <div class="row">
                @foreach($categorias as $categoria)
                <div class="col">
                    <div class="form-group">
                        <label for="f_{{ $categoria->name }}" class="font-weight-bold">{{ $categoria->name }}</label>
                        @foreach($opcoes as $opcao)
                        @if($opcao->category_id === $categoria->id)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="opcoes[]" id="{{ $opcao->id }}"
                                value="{{ $opcao->id }}">
                            <label class="form-check-label" for="{{ $opcao->id }}">
                                {{ $opcao->name }}
                            </label>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>

        <hr class="sidebar-divider">

        <!-- Formulário para selecionar a data -->
        <form action="{{ route('menus.index') }}" method="GET" class="mb-4">
            <div class="form-group">
                <label for="selected_date">Selecionar Data:</label>
                <input type="date" class="form-control" id="selected_date" name="selected_date"
                    value="{{ $selectedDate }}">
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Exibir os menus cadastrados para a data selecionada -->
        @if ($menus->isNotEmpty())
        <div class="card mt-4">
            <div>
                <h4>Menus Cadastrados para a Data Selecionada:</h4>
            </div>
            <div class="card-body">

                @foreach ($menus as $menu)
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p><strong>Restaurante:</strong> {{ $menu->restaurant->name }}</p>
                        <p><strong>Opções Selecionadas:</strong></p>
                        <ul>
                            @foreach ($menu->menuOptions as $menuOption)
                            <li>{{ $menuOption->option->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
        @else
        <p>Nenhum menu cadastrado para a data selecionada.</p>
        @endif
    </div>
</div>
@endsection