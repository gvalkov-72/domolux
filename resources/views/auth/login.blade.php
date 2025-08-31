@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('title', 'Вход')

@section('auth_header', 'Вход в системата')

@section('auth_body')
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Имейл адрес</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Парола</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Вход</button>
    </form>
@endsection
