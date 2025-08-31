@extends('adminlte::page')

@section('title', __('languages.permissions_create_title'))

@section('content_header')
    <h1>{{ __('languages.permissions_create_header') }}</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        @include('admin.permissions._form', ['permission' => null])
    </form>
@stop
