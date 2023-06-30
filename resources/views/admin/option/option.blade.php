@extends('admin.admin')

@section('content')

<div class="mx-4">

    <h1>Cadastrar Opções de Cardápio</h1>

    <form action="{{ route('options.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="name" placeholder="Ex: Arroz, Churrasco, Salada...">
        </div>

        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select class="form-control" id="categoria" name="category_id">
                <option value="" disabled selected>Selecione uma opção</option> <!-- Opção vazia como padrão -->
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
                <th>Nome</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($opcoes as $opcao)
            <tr>
                <td>{{ $opcao->name }}</td>
                <td>{{ $opcao->category->name }}</td>
                <td>

                    <a href="{{ route('options.edit', ['option' => $opcao->id]) }}" class="btn btn-primary">Editar</a>

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
</div>


@endsection