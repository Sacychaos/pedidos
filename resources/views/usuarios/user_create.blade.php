<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
    <link rel="stylesheet" href="/css/cadastro.css">
</head>

<body>
    <div class="container">

        <div class="buttonsForm">
            <div class="btnColor"></div>
            <button id="btnSignup">Cadastro de Usuário</button>
        </div>

        <form id="signup" action="{{ route('users.store') }}" method="post">
            @csrf

            <input type="text" id="name" name="name" placeholder="Nome Completo" autocomplete="new-password"
                onkeyup="this.value = capitalizeWords(this.value)" />

            <input type="text" id="username" name="username" placeholder="Usuário" autocomplete="new-password" />

            <input type="password" id="senha" name="senha" placeholder="Senha" autocomplete="new-password" />

            <select name="sector_id">
                <option value="" disabled selected>Escolha um Setor</option>
                @foreach ($sectors as $sector)
                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                @endforeach
            </select>

            <div class="checkbox-container">
                <input type="checkbox" id="is_admin" name="is_admin">
                <label for="is_admin">Administrador</label>
            </div>

            <button type="submit">Criar</button>
            <div class="checkbox-container">
                @if (session()->has('message'))
                {{ session()->get('message') }}
                @endif
            </div>


        </form>

    </div>

    <script src="/js/geral.js"></script>
</body>


</html>