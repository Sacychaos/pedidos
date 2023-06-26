@extends('admin.admin')

@section('content')
<h1>Cadastrar Tamanhos das Marmitas</h1>

<form action="{{ route('sizes.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nome">Tamanho Marmita</label>
        <input type="text" class="form-control" id="nome" name="name">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<h1>Tamanhos Cadastrados</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tamanho</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tamanhos as $tamanho)
        <tr>
            <td>{{ $tamanho->id }}</td>
            <td>{{ $tamanho->name }}</td>
            <td>
                <form action="{{ route('sizes.destroy', ['size' => $tamanho->id]) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Tem certeza que deseja excluir o tamanho?')">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection