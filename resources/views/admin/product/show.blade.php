@extends('layouts.admin', ['title' => 'Просмотр товара'])

@section('content')
    <h1>Просмотр товара</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Название:</strong> {{ $product->name }}</p>
            <p><strong>ЧПУ (англ):</strong> {{ $product->slug }}</p>
            <p><strong>Описание:</strong></p>
            @isset($product->content)
                <p>{{ $product->content }}</p>
            @else
                <p>Описание отсутствует</p>
            @endisset
        </div>
        <div class="col-md-6">
            @php
                if ($product->image) {
                    $url = url('storage/catalog/product/'.$product->image);
                }
                else {
                    $url = url('storage/catalog/no_img.png');
                }
            @endphp
            <img src="{{ $url }}" alt="image" class="img-fluid mx-auto d-block" width="300" height="400">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}" class="btn btn-success">Редактировать товар</a>
            <form method="post" class='d-inline' action="{{ route('admin.product.destroy', ['product' => $product->id]) }}" onsubmit="return confirm('Удалить этот товар?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">
                    Удалить товар
                </button>
            </form>
        </div>
    </div>
@endsection