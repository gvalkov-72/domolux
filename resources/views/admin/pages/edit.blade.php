@extends('adminlte::page')

@section('title', 'Редакция страница')

@section('content_header')
    <h1>Редакция страница</h1>
@stop

@section('content')
    <form action="{{ route('admin.pages.update', $page) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.pages.partials.form', ['page' => $page])

        <button type="submit" class="btn btn-success">Обнови</button>
    </form>
@stop
