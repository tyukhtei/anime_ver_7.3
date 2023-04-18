@extends('layouts.site')
@section('content')
    <div class="d-flex justify-content-end">
        <form action="#" method="get">
            <div class="form-check form-check-inline">
                <input type="checkbox" name="price" class="form-check-input" id="price-product">
                <label for="price-product" class="form-check-label">Цена</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" name="price" class="form-check-input" id="year-product">
                <label for="year-product" class="form-check-label">Цена</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" name="price" class="form-check-input" id="name-product">
                <label for="name-product" class="form-check-label">Цена</label>
            </div>

            <a href="{{ route('catalog.index') }}" class="btn btn-light">Сбросить</a>
        </form>
    </div>

    <h1>Каталог товаров</h1>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, ad, labore
        neque, mollitia magnam tempore dicta rem eius fugit odio illum recusandae provident 
        nostrum vero id quo obcaecati! Animi, odit.
    </p>

    <div class="row">
        @foreach ($roots as $root)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $root->name }}</h4>
                    </div>
                    <div class="card-body p-0">
                        @if ($root->in_stock)
                            <span class="badge badge-info bg-success text-white">В наличии</span>
                        @else
                            <span class="badge badge-info bg-danger text-white">Нет в наличии</span>
                        @endif

                        @php
                            if ($root->image){
                                $url = url('storage/catalog/product/'.$root->image);
                            }
                            else{
                                $url = url('storage/catalog/no_img.png');
                            }
                        @endphp
                        <img src="{{ $url }}" alt="" class="img-fluid mx-auto d-block" width="200" height="300">
                    </div>
                    <div class="card-footer">
                        @if ($root->in_stock)
                            <p>Цена: {{ $root->price }}</p>
                        @else
                            <p>Цена: 00.00</p>
                        @endif
                        
                        <a href="{{ route('catalog.product', ['slug' => $root->slug]) }}" class="btn btn-dark">Перейти к товару</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection