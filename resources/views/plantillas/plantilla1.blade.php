<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>La pape - Inventario</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <img height="130px" class="navbar-brand me-auto" src="{{asset('img/logo.png')}}" alt="">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <img height="40px" class="offcanvas-title" src="{{asset('img/logo.png')}}" alt="">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link fs-5 {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}"><img class="interfaz" height="50" src="{{asset('/img/inventario.png')}}" alt="">Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 {{ request()->is('venta/create') ? 'active' : '' }}" href="{{ url('/venta/create') }}"><img class="interfaz" height="50" src="{{ asset('/img/venta.png') }}" alt="">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 {{ request()->is('estadisticas/index') | request()->is('reporte/index') ? 'active' : '' }}" href="{{ url('estadisticas/index') }}"><img class="interfaz" height="50" src="{{asset('/img/vigilancia.png')}}" alt="">Estadisticas</a>
                        </li>
                    </ul>
                </div>
            </div>
            <img height="100px" class="navbar-brand me-auto cajas" src="{{asset('img/logoCoronado.png')}}" alt="">
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-center"></span>
            </button>
        </div>
    </nav>

    <div class="d-flex align-items-center justify-content-center">
        @yield("con1")
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>