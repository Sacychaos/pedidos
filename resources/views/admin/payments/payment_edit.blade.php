@extends('admin.admin')

@section('content')

<h1>Editar Tipo de Pagamento</h1>

<form action="{{ route('payments.update', ['payment' => $pagamento->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="name" value="{{ $pagamento->name }}"
            placeholder="Ex: Cartão">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
</form>

@endsection