@extends('adminlte::page')

@section('title', 'Секции')

@section('content_header')
    <h1>Секции</h1>
@stop

@section('content')
    <a href="{{ route('admin.sections.create') }}" class="btn btn-primary mb-3">Нова секция</a>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Key</th>
                        <th>Title</th>
                        <th>Position</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sections as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td>{{ $s->type }}</td>
                            <td>{{ $s->key }}</td>
                            <td>{{ $s->getTranslation('title', app()->getLocale()) }}</td>
                            <td>{{ $s->position }}</td>
                            <td>{{ $s->is_active ? 'Да' : 'Не' }}</td>
                            <td>
                                <a href="{{ route('admin.sections.edit', $s->id) }}" class="btn btn-sm btn-secondary">Редактирай</a>
                                <form action="{{ route('admin.sections.destroy', $s->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Изтриване?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Изтрий</button>
                                </form>
                                <a href="{{ route('admin.section_items.create') }}?section_id={{ $s->id }}" class="btn btn-sm btn-info">Добави елемент</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
