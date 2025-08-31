@extends('adminlte::page')

@section('title', __('languages.permissions_title'))

@section('content_header')
    <h1>{{ __('languages.permissions_header') }}</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.permissions.create') }}" class="btn btn-success mb-3">{{ __('languages.permissions_add') }}</a>

    <div class="card mb-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('languages.name') }}</th>
                    <th>{{ __('languages.created_at') }}</th>
                    <th>{{ __('languages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm">{{ __('languages.edit') }}</a>

                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('{{ __('languages.permissions_delete_confirm') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('languages.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
