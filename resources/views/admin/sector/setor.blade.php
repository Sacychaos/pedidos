@extends('admin.admin')

@section('content')
<h1>Cadastrar Setor</h1>

<form action="{{ route('sectors.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nome">Nome do Setor</label>
        <input type="text" class="form-control" id="nome" name="name" placeholder="Ex: Atendimento">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<h1>Setores Cadastrados</h1>

<table class="table">
    <thead>
        <tr>
            <th>Nome do Setor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($setores as $setor)
        <tr>
            <td>{{ $setor->name }}</td>
            <td>
                <form action="{{ route('sectors.destroy', ['sector' => $setor->id]) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Tem certeza que deseja excluir o setor?')">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection