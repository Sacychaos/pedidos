@extends('admin.admin')

@section('content')
<div class="table-responsive mx-4">
    <div class="mb-4">
        <form action="{{ route('users.index') }}" method="GET" class="form-inline">
            <div class="form-group mr-2">
                <label for="sector">Setor:</label>
                <select name="sector" id="sector" class="form-control">
                    <option value="">Todos</option>
                    @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mr-2">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome
                    @if (Request::input('sort') === 'asc' && Request::input('sort') !== null)
                    <i class="fas fa-sort-up"></i>
                    @endif
                    @if (Request::input('sort') === 'desc' && Request::input('sort') !== null)
                    <i class="fas fa-sort-down"></i>
                    @endif
                </th>
                <th scope="col">Setor
                    @if (Request::input('sort') === 'asc' && Request::input('sort') !== null)
                    <i class="fas fa-sort-up"></i>
                    @endif
                    @if (Request::input('sort') === 'desc' && Request::input('sort') !== null)
                    <i class="fas fa-sort-down"></i>
                    @endif
                </th>
                <th scope="col">Data de Criação</th>
                <th scope="col">Última Atualização</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->sector->name }}</td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</td>
                <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}</td>
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