<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/plugins/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e466ec6b27.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="shortcut icon" href="/img/com-alex.ico" type="image/x-icon">
    <title>{{$page_name}} | Comercial Alex</title>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header">
        <a class="app-header__logo" href="/">
            <p>"Comercial<span> Alex"</span></p>
        </a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Slider">
        </a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            {{--Reposición --}}
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-toggle="dropdown" >
                    <i class="fa fa-bell fa-lg" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu settings-menu">
                        <a class="dropdown-item" style="color:red"><strong>PRODUCTOS CON STOCK MÍNIMO</strong> </a>
                        @foreach(notificacion() as $noti)
                        <div class="dropdown-divider"></div>
                        <li>
                            <a class="dropdown-item" style="color:orange"><i
                                    class="fa fa-exclamation-triangle"></i> {{$noti->name}}</a>
                            <a class="dropdown-item" href="{{route('order.create')}}">{{$noti->stock}} unidades stock</a>
                        </li>
                        @endforeach
                    </ul>             
                </a>   
            </li>
            {{-- User Menu --}}
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                        class="fa fa-user fa-lg"> </i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    {{-- <li>
                        <a class="dropdown-item" href="#"><i class="fa fa-cog fa-lg"></i> Ajustes</a>
                    </li> --}}
                    <li>
                        <a class="dropdown-item" href="{{ route('user.profile', $user->id) }}"><i
                                class="fa fa-user fa-lg"></i> Perfil</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-lg"></i>
                            {{ __('Salir') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <img src="/img/avatar/{{auth()-> user()->name}}.png" class="img-circle elevation-2" alt="User Image">
            <div>
                <p class="col-12 app-sidebar__user-name" >
                    {{ $user->name}}
                </p>
                <p class="col-12 app-sidebar__user-designation">
                    {{ $user->workstation->work }}
                </p>
            </div>
        </div>
        <ul class="app-menu">
            <li>
                <a class="app-menu__item " href="{{ route('home') }}">
                    <i class="app-menu__icon fa fa-home"></i>
                    <span class="app-menu__label">
                        {{__('Inicio')}}
                    </span>
                </a>
            </li>
            @if ($user->workstation->work == "ADMINISTRADOR")
            <!-- usuarios -->
            <li class="treeview">
                <a class="app-menu__item col none" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">
                        {{__('Personal')}}
                    </span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu col none">
                    <li>
                        <a class="treeview-item" href="{{ route('employee') }}"><i class="icon fa fa-user"></i>
                            {{__('Empleados')}}
                        </a>
                        <a class="treeview-item" href="{{route('user')}}"><i class="icon fas fa-id-badge"></i>
                            {{__('Usuarios')}}
                        </a>

                    </li>
                </ul>
            </li>
            @endif


            @if ($user->workstation->work == "ADMINISTRADOR" || $user->workstation->work == "VENDEDOR")
            <!-- clientes -->
            <li class="treeview">
                <a class="app-menu__item col none" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">
                        {{__('Personas Externas')}}
                    </span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu col none">
                    <li>
                        <a class="treeview-item" href="{{ route('client') }}"><i class="icon fa fa-user"></i>
                            {{__('Clientes')}}
                        </a>
                        @if ($user->workstation->work == "ADMINISTRADOR")
                        <a class="treeview-item" href="{{route('supplier')}}"><i class="icon fas fa-id-badge"></i>
                            {{__('Proveedores')}}
                        </a>
                        @endif
                    </li>
                </ul>
            </li>
            @endif

            @if ($user->workstation->work == "ADMINISTRADOR" || $user->workstation->work == "VENDEDOR")
            <!-- ventas -->

            <li class="treeview">
                <a class="app-menu__item col none" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-user-tag"></i>
                    <span class="app-menu__label">
                        {{__('Venta')}}
                    </span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu col none">
                    <li>
                        <a class="treeview-item" href="{{route('sale')}}"><i class="icon fab fa-shopify"></i>
                            {{__('Ventas')}}
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($user->workstation->work == "ADMINISTRADOR")
            <!-- compras -->

            <li class="treeview">
                <a class="app-menu__item col none" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-shopping-cart"></i>
                    <span class="app-menu__label">
                        {{__('Compra')}}
                    </span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu col none">
                    <li>
                        <a class="treeview-item" href="{{route('order')}}"><i class="icon fas fa-clipboard-list"></i>
                            {{__('Pedidos')}}
                        </a>
                    </li>
                </ul>
                <ul class="treeview-menu col none">
                    <li>
                        <a class="treeview-item" href="{{route('buy')}}"><i class="icon fab fa-shopify"></i>
                            {{__('Compras')}}
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($user->workstation->work == "ADMINISTRADOR" || $user->workstation->work == "VENDEDOR")

            <!-- almacen -->
            <li class="treeview">
                <a class="app-menu__item col none" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fas fa-warehouse"></i>
                    <span class="app-menu__label">
                        {{__('Almacén')}}
                    </span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu col none">
                    <li>
                        <a class="treeview-item" href="{{route('product')}}"><i class="icon fas fa-boxes"></i>
                        {{__('Productos')}}
                        </a>
                        @if ($user->workstation->work == "ADMINISTRADOR")
                        <a class="treeview-item" href="{{route('category')}}"><i class=" icon fas fa-clipboard-list"></i>
                            {{__('Categorias')}}
                        </a>
                        @endif
                        @if ($user->workstation->work == "ADMINISTRADOR")
                        <a class="treeview-item" href="{{route('brand')}}"><i class=" icon fas fa-clipboard-list"></i>
                            {{__('Marcas')}}
                        </a>
                        @endif
                    </li>
                </ul>
            </li>

            @endif

            @if ($user->workstation->work == "ADMINISTRADOR" || $user->workstation->work == "VENDEDOR")

            <!-- reportes-->

            <li class="treeview">
                <a class="app-menu__item col none" href="#" data-toggle="treeview">
                    <i class="app-menu__icon far fa-file-alt"></i>
                    <span class="app-menu__label">
                        {{__('Reportes')}}
                    </span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu col none">
                    <li>
                        <a class="treeview-item" href="{{route('ventas.fecha')}}"><i class="icon fas fa-clipboard-list"></i>
                        {{__('Ventas')}}
                        </a>
                        @if ($user->workstation->work == "ADMINISTRADOR")
                        <a class="treeview-item" href="{{route('almacen.report')}}"><i class=" icon fas fa-clipboard-list"></i>
                            {{__('Almacén')}}
                        </a>
                        @endif
                        @if ($user->workstation->work == "ADMINISTRADOR")
                        <a class="treeview-item" href="{{route('compras.fecha')}}"><i class=" icon fas fa-clipboard-list"></i>
                            {{__('Compras')}}
                        </a>
                        @endif
                    </li>
                </ul>
            </li>

            @endif

            <li>
                <a class="app-menu__item " href="{{ route('ayuda') }}">
                    <i class="app-menu__icon fa fa-info-circle"></i>
                    <span class="app-menu__label">
                        {{__('Ayuda')}}
                    </span>
                </a>
            </li>

        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title py-4">
            <div>
                <h1><i class="{{$page_icon}} mr-2"></i>{{$page_name}}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">{{$page_name}}</li>
                <li class="breadcrumb-item"><a href="#">{{$page_subpage}}</a></li>
            </ul>
        </div>

        @yield('content')
    </main>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <!-- Toastr script -->
    <script src="{{asset('Inspinia/js/plugins/toastr/toastr.min.js')}}"></script>
    <!-- SweetAlert -->
    <script src="{{asset('SweetAlert/sweetalert2@10.js')}}"></script>
    <!-- Essential javascripts for application to work-->
    <script>
        function consultaExitosa() {
            // Swal.fire(
            //     '¡Búsqueda Exitosa!',
            //     'Datos ingresados.',
            //     'success'
            // )

            Swal.fire({
                icon: 'success',
                title: '¡Búsqueda Exitosa!',
                text: 'Datos ingresados.',
                customClass: {
                    container: 'my-swal'
                },
                showConfirmButton: false,
                timer: 1500
            })
        }

        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
        @endif

        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
    @yield('script')
</body>

</html>
