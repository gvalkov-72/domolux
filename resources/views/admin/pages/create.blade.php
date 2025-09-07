@extends('adminlte::page')

@section('title', 'Нова страница')

@section('content_header')
    <h1>Нова страница</h1>
@stop

@section('content')
    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf

        @include('admin.pages.partials.form', ['page' => null])

        <button type="submit" class="btn btn-success">Запази</button>
    </form>
@stop
