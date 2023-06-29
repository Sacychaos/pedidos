<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <img src="{{ asset('img\logo_guardiao.png') }}" style="max-width:100%;height:auto;">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('pedidos.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pedidos dos Usuários</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('pedidoadm') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Fazer um Pedido</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('meuspedidosadm') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Meus Pedidos</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Cadastros
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('menus.index') }}">
                    <i class=""></i>
                    <span>Cardápio do Dia</span>
                </a>

            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('restaurants.index') }}">
                    <i class=""></i>
                    <span>Restaurantes</span>
                </a>

            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('options.index') }}">
                    <i class=""></i>
                    <span>Cardápio Geral</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('categories.index') }}">
                    <i class=""></i>
                    <span>Categoria</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('sizes.index') }}">
                    <i class=""></i>
                    <span>Tam. Marmitas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('payments.index') }}">
                    <i class=""></i>
                    <span>Pagamentos</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Usuários
            </div>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.create') }}">
                    <i class=""></i>
                    <span>Novo Usuário</span>
                </a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <i class=""></i>
                    <span>Editar Usuário</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('sectors.index') }}">
                    <i class="fas fa-fw"></i>
                    <span>Setores</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow d-flex align-items-center">
                            <span class="mr-2 d-none d-sm-inline text-gray-600 small">{{ Auth::user()->name }}</span>

                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sair
                            </a>

                            <!-- Botão Sair -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Início do Conteúdo da Página -->
                <div>
                    <div id="page-content-wrapper" class="mx-4">
                        <!-- Aqui o conteúdo dinâmico das páginas do CRUD será carregado -->
                        @yield('content')
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/geral.js') }}"></script>

</body>

</html>