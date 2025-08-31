@extends('adminlte::page')

@section('title', __('roles.view_role_title'))

@section('content_header')
    <h1>{{ __('roles.view_role_header') }}: {{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5><strong>{{ __('roles.role_name_label') }}:</strong> {{ $role->name }}</h5>

            <h5><strong>{{ __('roles.permissions_label') }}:</strong></h5>
            @if($role->permissions->count())
                @foreach ($role->permissions as $permission)
                    <span class="badge bg-info">{{ $permission->name }}</span>
                @endforeach
            @else
                <p>{{ __('roles.no_permissions_for_role') }}</p>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mt-3">{{ __('roles.back_button') }}</a>
@stop
