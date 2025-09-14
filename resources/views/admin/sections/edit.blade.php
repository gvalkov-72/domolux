@extends('adminlte::page')

@section('title', 'Редакция на Секция')

@section('content_header')
    <h1>Редакция на Секция</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.sections.update', $section->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.sections.partials.form', ['section' => $section])
                <div class="mt-3">
                    <button class="btn btn-primary">Запази</button>
                    <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">Откажи</a>
                </div>
            </form>
        </div>
    </div>
@stop
