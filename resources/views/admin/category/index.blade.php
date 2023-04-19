@extends('layouts.admin', ['title' => 'Все категории каталога'])

@section('content')
    <h1>Все категории каталога</h1>
    <a href="{{ route('admin.category.create') }}" class="btn btn-success mb-4">
        Создать категорию
    </a>
    <table class="table table-bordered">
        <tr>
            <th width="30%">Наименование</th>
            <th width="65%">Описание</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @foreach ($roots as $root)
            <tr>
                <td>
                    <a href="{{ route('admin.category.show', ['category' => $root->id]) }}">
                        {{ $root->name }}
                    </a>
                </td>
                <td>{{ iconv_substr($root->content, 0, 150) }}</td>
                <td>
                    <a href="{{ route('admin.category.edit', ['category' => $root->id]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('admin.category.destroy', ['category' => $root->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="m-0 p-0 border-0 bg-transparent" type="submit">
                            <i class="far fa-trash-alt text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection