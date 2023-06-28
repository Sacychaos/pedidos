@extends('admin.admin')

@section('content')

<h1>Editar Setor</h1>

<form action="{{ route('sectors.update', ['sector' => $sector->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nome">Nome do Setor</label>
        <input type="text" class="form-control" id="nome" name="name" value="{{ $sector->name }}"
            placeholder="Ex: Atendimento">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
</form>

@endsection