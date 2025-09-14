@extends('adminlte::page')

@section('title', __('Редактиране на имот'))

@section('content_header')
    <h1><i class="fas fa-edit"></i> {{ __('Редактиране на имот') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.properties.form', ['property' => $property])

        <div class="card mt-3">
            <div class="card-footer text-right">
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Назад') }}
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ __('Запази промените') }}
                </button>
            </div>
        </div>
    </form>
@stop
