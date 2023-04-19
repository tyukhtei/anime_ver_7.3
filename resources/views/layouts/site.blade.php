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
                        <li class="nav-item menu"><a href="{{ route('index') }}" class="nav-link">О нас</a></li>
                        <li class="nav-item menu"><a href="{{ route('catalog.index') }}" class="nav-link">Каталог</a></li>
                        <li class="nav-item menu"><a href="{{ route('catalog.find') }}" class="nav-link">Где нас найти?</a></li>
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Войти</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Регистрация</a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link">Личный кабинет</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <h4>Разделы каталога</h4>
                <ul>
                    @foreach ($items as $item)
                        <li>
                            <a href="{{ route('catalog.category', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible mt-0" role="alert">
                        <button class="close" data-dismiss="alert" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>