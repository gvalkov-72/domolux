@extends('adminlte::page')

@section('title', __('users.create_user_title'))

@section('content_header')
    <h1>{{ __('users.create_user_header') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name">{{ __('users.name_label') }}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email">{{ __('users.email_label') }}</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password">{{ __('users.password_label') }}</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation">{{ __('users.confirm_password_label') }}</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role_id">{{ __('users.role_label') }}</label>
            <select name="role_id" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Поправен бутон: добавен type="submit" --}}
        <button type="submit" class="btn btn-success">{{ __('users.create_button') }}</button>
    </form>
@stop
