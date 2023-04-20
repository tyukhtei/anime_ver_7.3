@extends('layouts.admin', ['title' => 'Редактирование категории'])

@section('content')
    <h1>Редактирование категории</h1>
    <form method="post" action="{{ route('admin.category.update', ['category' => $category->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Наименование" maxlength="100" value="{{ old('name') ?? $category->name }}" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="title" placeholder="ЧПУ (на англ.)" maxlength="100" value="{{ old('slug') ?? $category->slug }}" required>
        </div>
        <div class="form-group">
            <textarea class="form-control" type="text" name="content" placeholder="Краткое описание" maxlength="200" rows="3">{{ old('content') ?? $category->content }}</textarea>
        </div>
        <div class="form-group">
            <input class="form-control-file" type="file" name="image" accept="image/png, image/jpeg">
        </div>
        @isset($category->image)
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