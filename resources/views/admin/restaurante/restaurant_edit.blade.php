@extends('admin.admin')

@section('content')
<h1>Editar Restaurante</h1>

<form action="{{ route('restaurants.update', ['restaurant' => $restaurante->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="name" value="{{ $restaurante->name }}">
    </div>

    <div class="form-group">
        <label for="phone">Telefone</label>
        <input type="tel" class="form-control" id="phone" name="phone" value="{{ $restaurante->phone }}">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
</form>
@endsection