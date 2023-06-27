@extends('admin.admin')

@section('content')

<div>
    <div class="usercreate">

        <form id="signup" action="{{ route('users.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" placeholder="Nome Completo" autocomplete="new-password"
                    onkeyup="this.value = capitalizeWords(this.value)" class="form-control" />
            </div>

            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" placeholder="Usuário" autocomplete="new-password"
                    class="form-control" />
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Senha" autocomplete="new-password"
                    class="form-control" />
            </div>

            <div class="form-group">
                <label for="sector_id">Setor</label>
                <select name="sector_id" class="form-select">
                    <option value="" disabled selected>Escolha um Setor</option>
                    @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" id="is_admin" name="is_admin" class="form-check-input">
                    <label for="is_admin" class="form-check-label">Administrador</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Criar</button>

        </form>
    </div>
</div>

@endsection