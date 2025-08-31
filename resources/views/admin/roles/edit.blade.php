@extends('adminlte::page')

@section('title', __('roles.edit_role_title'))

@section('content_header')
    <h1>{{ __('roles.edit_role_header') }}: {{ $role->name }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">{{ __('roles.role_name_label') }}:</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
        </div>

        <div class="mb-3">
            <label>{{ __('roles.permissions_label') }}:</label>
            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                value="{{ $permission->id }}"
                                {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('roles.save_button') }}</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">{{ __('roles.back_button') }}</a>
    </form>
@stop
