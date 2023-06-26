@extends('admin.admin')

@section('content')
<h1>Cadastrar Restaurante</h1>

<form action="{{ route('restaurants.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="name">
    </div>

    <div class="form-group">
        <label for="phone">Telefone</label>
        <input type="tel" class="form-control" id="phone" name="phone">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<h1>Restaurantes Cadastrados</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tamanho</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($restaurantes as $restaurante)
        <tr>
            <td>{{ $restaurante->id }}</td>
            <td>{{ $restaurante->name }}</td>
            <td>{{ $restaurante->phone }}</td>
            <td>
                <form action="{{ route('restaurants.destroy', ['restaurant' => $restaurante->id]) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Tem certeza que deseja excluir o restaurante?')">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection