@extends('layouts.admin', ['title' => 'Все категории каталога'])

@section('content')
    <h1>Панель управления</h1>
    <p>Добро пожаловать, {{ auth()->user()->name }}</p>
    <p>Это панель управления для администратора интернет-магазина.</p>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="btn btn-primary" type="submit">Выйти</button>
    </form>
@endsection