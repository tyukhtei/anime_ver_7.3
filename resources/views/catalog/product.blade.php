@extends('layouts.site')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-8">
                            @if ($product->in_stock)
                                <span class="badge badge-info bg-success text-white">В наличии</span>
                            @else
                                <span class="badge badge-info bg-danger text-white">Нет в наличии</span>
                            @endif

                            @if ($product->in_stock)
                                <p class="mt-4"><b>Цена: </b>{{ number_format($product->price, 2, '.', '') }}</p>
                            @else
                            <p class="mt-4"><b>Цена: </b> 00.00</p>
                            @endif

                            <p class="mt-4"><b>Описание: </b>{{ $product->content }}</p>
                            <p class="mt-4"><b>Издательство: </b>{{ $product->publishing }}</p>
                            <p class="mt-4"><b>Год выпуска: </b>{{ $product->year }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            Категория:
                            <a href="{{ route('catalog.category', ['slug' => $product->category_slug]) }}">
                                {{ $product->category_name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection