<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/welcome/welcome.css" />
    <link rel="shortcut icon" href="/img/com-alex.ico" type="image/x-icon">
    <title>Inicio | Comercial Alex</title>
</head>

<body>
    <div class="banner">
        <nav class="banner-nav">
            <div class="hg-full pos-relative d-flex align-items-center justify-content-between pt-3">
                <div class="nav-logo">
                    <a href="/">
                        <h4 class="text-white">
                            Comercial<span class="text-white font-weight-bold"> "ALEX"</span>
                        </h4>
                    </a>
                </div>

                @auth
                <div class="d-flex align-items-center justify-content-end">
                    <a class="mr-2" href="/home">
                        <h6 class="text-white text-uppercase">{{__('INICIO')}}</h6>
                    </a>
                    <a class="ml-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <h6 class="text-white text-uppercase">{{__('SALIR')}}</h6>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                @endauth

                @guest
                <div class="d-flex align-items-center justify-content-end">
                    <a class="mr-2" href="/login">
                        <h6 class="text-white text-uppercase">{{__('INGRESAR')}}</h6>
                    </a>
                   
                </div>
                @endguest

            </div>
        </nav>

        <div class="banner-post container">
           
            <div class="banner-post-description text-white">
                <h1 class="banner-post-description-title">
                    <strong class="inherits-color text-uppercase">BIENVENIDO</strong><br />
                </h1>
                <h3> ¡Precios más bajos siempre!</h3>
                <p class="banner-post-description-body">
                    Comercial Alex te ofrece articulos de calidad y a un exelente precio.<br />
                    Visitanos en nuestro local y adquiere los mejores articulos para el hogar.
                </p>
            </div>
            <div class="banner-post-image ">
                <img src="/img/com-alex.png" alt="welcome Illustration">
            </div>

        </div>
    </div>
</body>

</html>