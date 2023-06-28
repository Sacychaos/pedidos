@extends('admin.admin')

@section('content')
<div>
    <h1>Editar Tamanho</h1>

    <form action="{{ route('sizes.update', ['size' => $tamanho->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Tamanho</label>
            <input type="text" class="form-control" id="nome" name="name" value="{{ $tamanho->name }}"
                placeholder="Ex: Pequena, Média ou Grande">
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </form>
</div>
@endsection