@extends('layouts.site')

@section('content')
    <h1>Личный кабинет</h1>
    <p>Добро пожаловать, {{ Auth::user()->name }}</p>
    <p>Это личный кабинет постоянного покупателя нашего интернет-магазина.</p>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Выйти</button>
    </form>
@endsection