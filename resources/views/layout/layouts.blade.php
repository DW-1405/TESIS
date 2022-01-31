<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS only -->
    <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login/login.css">

    <script src="https://kit.fontawesome.com/e466ec6b27.js" crossorigin="anonymous"></script>
    {{--<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script> --}}

    <link rel="shortcut icon" href="/img/com-alex.ico" type="image/x-icon">

    <title>{{$name_page}} | Comercial Alex</title>
</head>

<body>


    <div class="container">

        <div class="row contenedor">
            
            <div class="col-12 contenedor-right ">
                @yield('content')
            </div>

        </div>

    </div>


    <!-- JS, Popper.js, and jQuery -->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"> </script>
    <script src="/js/login/login.js"></script>
    <!-- SweetAlert -->
    <script src="{{asset('SweetAlert/sweetalert2@10.js')}}"></script>
    @yield('scripts')
</body>

</html>
