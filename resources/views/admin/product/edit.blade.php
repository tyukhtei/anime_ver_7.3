@extends('layouts.admin', ['title' => 'Редактирование товара'])

@section('content')
    <h1>Редактирование товара</h1>
    <form method="post" action="{{ route('admin.product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Наименование" maxlength="100" value="{{ old('name') ?? $product->name ?? '' }}" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="slug" placeholder="ЧПУ (на англ.)" maxlength="100" value="{{ old('slug') ?? $product->slug ?? '' }}" required>
        </div>
        <div class="form-group">
            @php
                $catagory_id = old('category_id') ?? $product->category_id ?? 0;
            @endphp
            <select name="category_id" class="form-control" title="Категория">
                <option value="0">Выберите</option>
                @if (count($items))
                    @include('admin.product.part.branch', ['level' => -1, 'parent' => 0])
                @endif
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="content" placeholder="Описание" rows="4">{{ old('content') ?? $product->content ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <input class="form-control-file" type="file" name="image" accept="image/png, image/jpeg">
        </div>
        @isset($product->image)
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remove" id="remove">
                <label for="remove" class="form-check-label">Удалить загруженное изображение</label>
            </div>
        @endisset
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </div>
    </form>
@endsection