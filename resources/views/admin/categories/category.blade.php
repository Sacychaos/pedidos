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
            <th>Nome</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection