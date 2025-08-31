@extends('adminlte::page')

@section('title', __('users.show_user_title'))

@section('content_header')
    <h1>{{ __('users.show_user_header') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <h5><strong>{{ __('users.id') }}:</strong> {{ $user->id }}</h5>

            <h5><strong>{{ __('users.name') }}:</strong> {{ $user->name }}</h5>

            <h5><strong>{{ __('users.email') }}:</strong> {{ $user->email }}</h5>

            <h5><strong>{{ __('users.roles') }}:</strong>
                @forelse ($user->roles as $role)
                    <span class="badge bg-primary">{{ $role->name }}</span>
                @empty
                    <span class="text-muted">{{ __('users.no_roles') }}</span>
                @endforelse
            </h5>

            <h5><strong>{{ __('users.permissions') }}:</strong>
                @php
                    $permissions = $user->roles->flatMap(function($role) {
                        return $role->permissions;
                    })->pluck('name')->unique();
                @endphp

                @forelse ($permissions as $permission)
                    <span class="badge bg-success">{{ $permission }}</span>
                @empty
                    <span class="text-muted">{{ __('users.no_permissions') }}</span>
                @endforelse
            </h5>

            <h5><strong>{{ __('users.created_at') }}:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</h5>

            <h5><strong>{{ __('users.updated_at') }}:</strong> {{ $user->updated_at->format('d.m.Y H:i') }}</h5>

            <h5><strong>{{ __('users.last_login') }}:</strong>
                {{ $user->last_login_at ? $user->last_login_at->format('d.m.Y H:i') : __('users.no_last_login') }}
            </h5>

        </div>
    </div>

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">{{ __('users.back_button') }}</a>
@stop
