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
    <!-- Bootstrap Icons -->
    <link href="{{ asset('icons/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Data Tables-->
    <script src="{{ asset('js/datatables.js') }}"></script>
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-cinza sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <img src="{{ asset('img\logo_guardiao.png') }}" style="max-width:100%;height:auto;">
            </a>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('pedidos.index') }}">
                    <span>Pedidos dos Usuários</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('pedidoadm') }}">

                    <span>Fazer um Pedido</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('meuspedidosadm') }}">

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
                    <i class="bi bi-card-checklist"></i>
                    <span>Cardápio do Dia</span>
                </a>

            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('restaurants.index') }}">
                    <i class="bi bi-shop"></i>
                    <span>Restaurantes</span>
                </a>

            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('options.index') }}">
                    <i class="bi bi-list-task"></i>
                    <span>Cardápio Geral</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('categories.index') }}">
                    <i class="bi bi-bookmark-check"></i>
                    <span>Categoria</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('sizes.index') }}">
                    <i class="bi bi-aspect-ratio"></i>
                    <span>Tam. Marmitas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('payments.index') }}">
                    <i class="bi bi-credit-card-2-back"></i>
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
                    <i class="bi bi-person-plus"></i>
                    <span>Novo Usuário</span>
                </a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <i class="bi bi-person"></i>
                    <span>Usuários</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('sectors.index') }}">
                    <i class="bi bi-diagram-3"></i>
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
                <nav class="navbar navbar-expand navbar-light bg-cinza topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-sm-inline text-white small">{{ Auth::user()->name }}</span>
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Início do Conteúdo da Página -->

                <div>
                    <!-- Aqui o conteúdo dinâmico das páginas será carregado -->
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/geral.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
    </script>

</body>

</html>