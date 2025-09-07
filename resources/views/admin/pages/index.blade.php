@extends('adminlte::page')

@section('title', 'Страници')

@section('content_header')
    <h1>Страници</h1>
@stop

@section('content')
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary mb-3">Нова страница</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Заглавие</th>
                <th>Активна</th>
                <th>Подредба</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>{{ $page->getTranslation('title', app()->getLocale()) }}</td>
                    <td>{{ $page->is_active ? 'Да' : 'Не' }}</td>
                    <td>{{ $page->sort_order }}</td>
                    <td>
                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-warning">Редакция</a>
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Изтриване?')">Изтриване</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pages->links() }}
@stop
