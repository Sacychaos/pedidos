<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="/css/cadastro.css">
</head>

<body>
    <div class="container">
        <form id="signup" action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <label for="nome"></label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" />
            <label for="usuario"></label>
            <input type="text" id="username" name="username" value="{{ $user->username }}" />
            <label for="senha"></label>
            <input type="password" id="password" name="password" value="" placeholder="nova senha"
                autocomplete="new-password" />
            <select name="sector_id">
                @foreach ($sectors as $sector)
                <option value="{{ $sector->id }}" @if ($sector->id == $user->sector_id) selected @endif>
                    {{ $sector->name }}</option>
                @endforeach
            </select>

            <div class="checkbox-container">
                <label for="is_admin">Administrador:</label>
                <input type="checkbox" id="is_admin" name="is_admin" @if ($user->is_admin) checked @endif>
            </div>
            <button type="submit">Atualizar</button>
            <div><a href="/users">Voltar</a></div>
        </form>
        @if (session()->has('message'))
        {{ session()->get('message') }}
        @endif

    </div>


    <script src="/js/geral.js"></script>
</body>


</html>