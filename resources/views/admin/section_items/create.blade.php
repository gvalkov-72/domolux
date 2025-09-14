@extends('adminlte::page')

@section('title', 'Нов елемент на секция')

@section('content_header')
    <h1>Нов елемент на секция</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.section_items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.section_items.partials.form', ['sectionItem' => null])
                <div class="mt-3">
                    <button class="btn btn-primary">Запази</button>
                    <a href="{{ route('admin.section_items.index') }}" class="btn btn-secondary">Откажи</a>
                </div>
            </form>
        </div>
    </div>
@stop
