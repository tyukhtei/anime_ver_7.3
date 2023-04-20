@extends('layouts.admin', ['title' => 'Просмотр категории'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Просмотр категории</h1>
            <p><strong>Название:</strong> {{ $category->name }}</p>
            <p><strong>ЧПУ (англ):</strong> {{ $category->slug }}</p>
            <p><strong>Краткое описание:</strong><p>
            <p>{{ $category->content }}</p>
        </div>
        <div class="col-md-6">
            @php
                if ($category->image) {
                    $url = url('storage/catalog/category/'.$category->image);
                }
                else {
                    $url = url('storage/catalog/no_img.png');
                }
            @endphp
            <img src="{{ $url }}" alt="image" class="img-fluid mx-auto d-block" width="400" height="500">
        </div>
    </div>
    <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}" class="btn btn-success">Редактировать категорию</a>
    <form method="post" class='d-inline' action="{{ route('admin.category.destroy', ['category' => $category->id]) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">
            Удалить категорию
        </button>
    </form>
@endsection