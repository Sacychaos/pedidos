@extends('admin.admin')

@section('content')

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Setor</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->sector->name }}</td>
                <td>
                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">Editar</a>

                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Tem certeza que deseja excluir o usuário?')">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection