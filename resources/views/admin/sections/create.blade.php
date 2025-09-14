@extends('adminlte::page')

@section('title', 'Нова Секция')

@section('content_header')
    <h1>Нова Секция</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.sections.store') }}" method="POST">
                @csrf
                @include('admin.sections.partials.form', ['section' => null])
                <div class="mt-3">
                    <button class="btn btn-primary">Запази</button>
                    <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">Откажи</a>
                </div>
            </form>
        </div>
    </div>
@stop
