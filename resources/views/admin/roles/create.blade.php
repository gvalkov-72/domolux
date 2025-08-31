@extends('adminlte::page')

@section('title', __('roles.roles.create_title'))

@section('content_header')
    <h1>{{ __('roles.roles.create_header') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name">{{ __('roles.roles.name_label') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>{{ __('roles.roles.permissions_label') }}</label>
            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                            <label class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('roles.roles.create_button') }}</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">{{ __('roles.roles.back_button') }}</a>
    </form>
@stop
