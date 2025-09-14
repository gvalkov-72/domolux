@extends('adminlte::page')

@section('title', 'Редакция на елемент')

@section('content_header')
    <h1>Редакция на елемент</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.section_items.update', $sectionItem->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.section_items.partials.form', ['sectionItem' => $sectionItem])
                <div class="mt-3">
                    <button class="btn btn-primary">Запази</button>
                    <a href="{{ route('admin.section_items.index') }}" class="btn btn-secondary">Откажи</a>
                </div>
            </form>
        </div>
    </div>
@stop
