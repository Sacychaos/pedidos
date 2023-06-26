@extends('admin.admin')

@section('content')
<h1>Cadastrar Categorias</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nome">Categoria</label>
        <input type="text" class="form-control" id="nome" name="name">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<h1>Categorias Cadastradas</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->name }}</td>
            <td>
                <form action="{{ route('categories.destroy', ['category' => $categoria->id]) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Tem certeza que deseja excluir a categoria?')">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection