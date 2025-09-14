@extends('adminlte::page')

@section('title', 'Елементи на секции')

@section('content_header')
    <h1>Елементи на секции</h1>
@stop

@section('content')
    <a href="{{ route('admin.section_items.create') }}" class="btn btn-primary mb-3">Нов елемент</a>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Section</th>
                        <th>Title</th>
                        <th>Position</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->section->type ?? $i->section->key }}</td>
                            <td>{{ $i->getTranslation('title', app()->getLocale()) }}</td>
                            <td>{{ $i->position }}</td>
                            <td>{{ $i->is_active ? 'Да' : 'Не' }}</td>
                            <td>
                                <a href="{{ route('admin.section_items.edit', $i->id) }}" class="btn btn-sm btn-secondary">Редактирай</a>
                                <form action="{{ route('admin.section_items.destroy', $i->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Изтриване?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Изтрий</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
