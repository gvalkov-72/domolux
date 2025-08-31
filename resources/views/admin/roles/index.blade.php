@extends('adminlte::page')

@section('title', __('roles.roles_title'))

@section('content_header')
    <h1>{{ __('roles.roles_header') }}</h1>
@stop

@section('content')
    <a href="{{ route('admin.roles.create') }}" class="btn btn-success mb-3">+ {{ __('roles.new_role') }}</a>
    <div class="card mb-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('roles.name') }}</th>
                    <th>{{ __('roles.permissions') }}</th>
                    <th>{{ __('roles.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <span class="badge bg-info">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-sm btn-info">{{ __('roles.view') }}</a>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">{{ __('roles.edit') }}</a>
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('{{ __('roles.confirm_delete_role') }}');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">{{ __('roles.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
