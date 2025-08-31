@extends('adminlte::page')

@section('title', __('languages.permissions_edit_title'))

@section('content_header')
    <h1>{{ __('languages.permissions_edit_header') }}</h1>
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

    <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.permissions._form', ['permission' => $permission])
    </form>
@stop
