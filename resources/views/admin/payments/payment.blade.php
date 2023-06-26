@extends('admin.admin')

@section('content')
<h1>Tipo de Pagamento</h1>

<form action="{{ route('payments.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="name">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<h1>Pagamentos Cadastrados</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pagamentos as $pagamento)
        <tr>
            <td>{{ $pagamento->id }}</td>
            <td>{{ $pagamento->name }}</td>
            <td>
                <form action="{{ route('payments.destroy', ['payment' => $pagamento->id]) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Tem certeza que deseja excluir o tipo de pagamento?')">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection