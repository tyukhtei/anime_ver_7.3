@extends('layouts.site')
@section('content')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->content }}</p>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $product->name }}</h4>
                    </div>
                    <div class="card-body p-0">
                        @if ($product->in_stock)
                            <span class="badge badge-info bg-success text-white">В наличии</span>
                        @else
                            <span class="badge badge-info bg-danger text-white">Нет в наличии</span>
                        @endif

                        @php
                            if ($product->image){
                                $url = url('storage/catalog/product/'.$product->image);
                            }
                            else{
                                $url = url('storage/catalog/no_img.png');
                            }
                        @endphp
                        <img src="{{ $url }}" alt="product" class="img-fluid mx-auto d-block" width="200" height="300">
                    </div>
                    <div class="card-footer">
                        @if ($product->in_stock)
                            <p>Цена: {{ $product->price }}</p>
                        @else
                            <p>Цена: 00.00</p>
                        @endif
                        
                        <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}" class="btn btn-dark">Перейти к товару</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection