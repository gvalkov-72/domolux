@extends('adminlte::page')

@section('title', __('Създаване на имот'))

@section('content_header')
    <h1><i class="fas fa-plus-circle"></i> {{ __('Създаване на имот') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.properties.form', ['property' => new \App\Models\Property])

        <div class="card mt-3">
            <div class="card-footer text-right">
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Назад') }}
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ __('Запази') }}
                </button>
            </div>
        </div>
    </form>
@stop
