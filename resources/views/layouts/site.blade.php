<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funny Comics Land</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav class="navbar fixed-top sticky-top navbar-expand-md navbar-light mt-3 my-5">
            <div class="container">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-brand" width="80" height="80">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse box1" id="navbarContent">
                    <ul class="navbar-nav">
                        <li class="nav-item menu"><a href="#" class="nav-link">О нас</a></li>
                        <li class="nav-item menu"><a href="#" class="nav-link">Каталог</a></li>
                        <li class="nav-item menu"><a href="#" class="nav-link">Где нас найти?</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <h4>Разделы каталога</h4>
                <p>Здесь будут корневые разделы</p>
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>