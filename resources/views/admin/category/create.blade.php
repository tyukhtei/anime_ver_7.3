@extends('layouts.admin', ['title' => 'Создание категории'])

@section('content')
    <h1>Создание новой категории</h1>
    <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Наименование" maxlength="100" value="{{ old('name') ?? '' }}" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="slug" placeholder="ЧПУ (на англ.)" maxlength="100" value="{{ old('slug') ?? '' }}" required>
        </div>
        <div class="form-group">
            <textarea class="form-control" type="text" name="content" placeholder="Краткое описание" maxlength="200" rows="3">{{ old('content') ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <input class="form-control-file" type="file" name="image" accept="image/png, image/jpeg">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </div>
    </form>
@endsection