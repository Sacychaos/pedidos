@extends('admin.admin')

@section('content')

<div class="mx-4">

    <h1>Categorias</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection