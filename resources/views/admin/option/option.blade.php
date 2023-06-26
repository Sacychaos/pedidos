@extends('admin.admin')

@section('content')
<h1>Cadastrar Opções de Cardápio</h1>

<form action="{{ route('options.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="name">
    </div>

    <div class="form-group">
        <label for="categoria">Categoria</label>
        <select class="form-control" id="categoria" name="category_id">
            @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<h1>Opções Cadastradas</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($opcoes as $opcao)
        <tr>
            <td>{{ $opcao->id }}</td>
            <td>{{ $opcao->name }}</td>
            <td>{{ $opcao->category->name }}</td>
            <td>
                <form action="{{ route('options.destroy', ['option' => $opcao->id]) }}" method="POST"
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
@endsection