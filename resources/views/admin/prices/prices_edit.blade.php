@extends('admin.admin')

@section('content')

<div class="mx-4">

    <h1>Editar Preço Marmitas</h1>

    <form action="{{ route('prices.update', ['price' => $price->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="restaurante">Restaurante</label>
            <select class="form-control" id="restaurante" name="restaurante_id">
                @foreach($restaurantes as $restaurante)
                <option value="{{ $restaurante->id }}"
                    {{ $restaurante->id == $price->restaurant_id ? 'selected' : "" }}>
                    {{ $restaurante->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tamanho">Tamanho</label>
            <select class="form-control" id="tamanho" name="tamanho_id">
                @foreach($tamanhos as $tamanho)
                <option value="{{ $tamanho->id }}" {{ $tamanho->id == $price->size_id ? 'selected' : "" }}>
                    {{ $tamanho->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="text" class="form-control campo-numerico" maxlength="6" id="price" name="price"
                value="{{ $price->price }}">
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </form>
</div>

@endsection