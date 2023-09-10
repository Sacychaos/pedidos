@extends('admin.admin')

@section('content')
<h1 class="card mx-4 text-center">Cadastrar Cardápio do Dia</h1>

<div class="card mx-4">

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
                {{-- Loop para a categoria "Opções" --}}
                @foreach($categorias as $categoria)
                    @if($categoria->name === 'Opções')
                        <div class="col">
                            <div class="form-group">
                                <label for="f_{{ $categoria->name }}" class="font-weight-bold">{{ $categoria->name }}</label>
                                <input type="text" id="search_{{ $categoria->name }}" class="form-control" placeholder="Pesquisar...">
                                <div class="options-list">
                                    @foreach($opcoes->where('category_id', $categoria->id)->sortBy('name') as $opcao)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcoes[]" id="{{ $opcao->id }}"
                                                value="{{ $opcao->id }}">
                                            <label class="form-check-label" for="{{ $opcao->id }}">
                                                {{ $opcao->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- Loop para a categoria "Carnes" --}}
                @foreach($categorias as $categoria)
                    @if($categoria->name === 'Carnes')
                        <div class="col">
                            <div class="form-group">
                                <label for="f_{{ $categoria->name }}" class="font-weight-bold">{{ $categoria->name }}</label>
                                <input type="text" id="search_{{ $categoria->name }}" class="form-control" placeholder="Pesquisar...">
                                <div class="options-list">
                                    @foreach($opcoes->where('category_id', $categoria->id)->sortBy('name') as $opcao)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcoes[]" id="{{ $opcao->id }}"
                                                value="{{ $opcao->id }}">
                                            <label class="form-check-label" for="{{ $opcao->id }}">
                                                {{ $opcao->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- Loop para a categoria "Acompanhamentos" --}}
                @foreach($categorias as $categoria)
                    @if($categoria->name === 'Acompanhamentos')
                        <div class="col">
                            <div class="form-group">
                                <label for="f_{{ $categoria->name }}" class="font-weight-bold">{{ $categoria->name }}</label>
                                <input type="text" id="search_{{ $categoria->name }}" class="form-control" placeholder="Pesquisar...">
                                <div class="options-list">
                                    @foreach($opcoes->where('category_id', $categoria->id)->sortBy('name') as $opcao)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcoes[]" id="{{ $opcao->id }}"
                                                value="{{ $opcao->id }}">
                                            <label class="form-check-label" for="{{ $opcao->id }}">
                                                {{ $opcao->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>

    </div>
</div>

<br>

<div class="card mx-4">

    <div class="card-body" id="pedidoform">

        <div>
            <h2>Cardápios Cadastrados:</h2>
        </div>

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

            <div class="card-body">

                @foreach ($menus as $menu)
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p><strong>Restaurante:</strong> {{ $menu->restaurant ? $menu->restaurant->name : 'Nome não disponível'}}</p>
                        <p><strong>Opções Selecionadas:</strong></p>
                        <ul>
                            @foreach ($menu->menuOptions as $menuOption)
                            <li>{{ $menuOption->option ? $menuOption->option->name : 'Nome da opção não disponível' }}</li>
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

<script>
    // Adicione o seguinte código JavaScript para lidar com a pesquisa em cada coluna.
    document.addEventListener("DOMContentLoaded", function() {
        // Seleciona todas as caixas de pesquisa
        const searchInputs = document.querySelectorAll('[id^="search_"]');

        // Adiciona um evento de input a cada caixa de pesquisa
        searchInputs.forEach(function(input) {
            input.addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                const optionsList = this.closest('.form-group').querySelector('.options-list');

                // Filtra os itens com base no valor da caixa de pesquisa
                optionsList.querySelectorAll('.form-check').forEach(function(option) {
                    const label = option.querySelector('.form-check-label').textContent.toLowerCase();
                    if (label.includes(searchTerm)) {
                        option.style.display = "block";
                    } else {
                        option.style.display = "none";
                    }
                });
            });
        });
    });
</script>

@endsection
