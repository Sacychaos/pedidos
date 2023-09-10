@extends('admin.admin')

@section('content')

<div class="mx-4">

    <h1>Cadastrar Preço das Marmitas</h1>

    <form action="{{ route('prices.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="restaurante">Restaurante</label>
            <select class="form-control" id="restaurante" name="restaurante_id" required>
                <option value="" disabled selected>Selecione um Restaurante</option> <!-- Opção vazia como padrão -->
                @foreach($restaurantes as $restaurante)
                <option value="{{ $restaurante->id }}">{{ $restaurante->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tamanho">Tamanho</label>
            <select class="form-control" id="tamanho" name="tamanho_id" required>
                <option value="" disabled selected>Selecione um Tamanho</option> <!-- Opção vazia como padrão -->
                @foreach($tamanhos as $tamanho)
                <option value="{{ $tamanho->id }}">{{ $tamanho->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="text" class="form-control campo-numerico" maxlength="6" id=" price" name="price" required>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>


    <h1>Preços Cadastrados</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Restaurante</th>
                <th>Tamanho</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prices as $price)
            <tr>
                <td>{{ $price->restaurant ? $price->restaurant->name : '' }}</td>
                <td>{{ $price->size->name }}</td>
                <td>{{ $price->price }}</td>
                <td>

                    <a href="{{ route('prices.edit', ['price' => $price->id]) }}" class="btn btn-primary">Editar</a>

                    <form method="POST" action="{{ route('prices.destroy', ['price' => $price->id]) }}"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Tem certeza que deseja excluir a opção?')">Deletar</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
