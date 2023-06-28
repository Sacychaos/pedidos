@extends('admin.admin')

@section('content')
<h1>Editar Opção de Cardápio</h1>

<form action="{{ route('options.update', ['option' => $opcao->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="name" value="{{ $opcao->name }}"
            placeholder="Ex: Arroz, Churrasco, Salada...">
    </div>

    <div class="form-group">
        <label for="categoria">Categoria</label>
        <select class="form-control" id="categoria" name="category_id">
            <option value="" disabled selected>Selecione uma opção</option> <!-- Opção vazia como padrão -->
            @foreach($categorias as $category)
            <option value="{{ $category->id }}" {{ $opcao->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
</form>
@endsection