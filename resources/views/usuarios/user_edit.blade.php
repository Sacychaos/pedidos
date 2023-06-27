@extends('admin.admin')

@section('content')

<div class="container">
    <form id="signup" action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" />
        </div>
        <div class="form-group">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control" />
        </div>
        <div class="form-group">
            <label for="password">Nova Senha:</label>
            <input type="password" id="password" name="password" placeholder="Nova Senha" autocomplete="new-password"
                class="form-control" />
        </div>
        <div class="form-group">
            <label for="sector_id">Setor:</label>
            <select name="sector_id" class="form-select">
                @foreach ($sectors as $sector)
                <option value="{{ $sector->id }}" @if ($sector->id == $user->sector_id) selected @endif>
                    {{ $sector->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" id="is_admin" name="is_admin" class="form-check-input" @if ($user->is_admin)
                checked @endif>
                <label for="is_admin" class="form-check-label">Administrador</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>


@endsection