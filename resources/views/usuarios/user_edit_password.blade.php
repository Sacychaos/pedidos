@extends('admin.master')

@section('content')

<div class="mx-4">
    <form id="change-password" action="{{ route('users.updatePassword', ['user' => $user]) }}" method="post">
        @method('PUT')
        @csrf

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" disabled />
        </div>

        <div class="form-group">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control"
                disabled />
        </div>

        <div class="form-group">
            <label for="password">Nova Senha:</label>
            <input type="password" id="password" name="password" placeholder="Nova Senha" autocomplete="new-password"
                class="form-control" required />
        </div>

        <div class="form-group">
            <label for="sector_id">Setor:</label>
            <select name="sector_id" class="form-select" disabled>
                @foreach ($sectors as $sector)
                <option value="{{ $sector->id }}" @if ($sector->id == $user->sector_id) selected @endif>
                    {{ $sector->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Senha</button>
    </form>
</div>

@endsection