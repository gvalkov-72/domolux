@extends('adminlte::page')

@section('title', __('countries.title'))

@section('content_header')
    <h1>{{ __('countries.title') }}</h1>
@stop

@section('content')
    <a href="{{ route('admin.countries.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> {{ __('countries.create') }}
    </a>

    @if(session('success'))
        <x-adminlte-alert theme="success" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('countries.code') }}</th>
                <th>{{ __('countries.name') }}</th>
                <th>{{ __('countries.active') }}</th>
                <th>{{ __('countries.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->code }}</td>
                    <td>{{ $country->getTranslation('name') }}</td>
                    <td>
                        <x-adminlte-button theme="{{ $country->is_active ? 'success' : 'danger' }}" disabled>
                            {{ $country->is_active ? __('countries.active') : __('countries.inactive') }}
                        </x-adminlte-button>
                    </td>
                    <td>
                        <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.countries.destroy', $country) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('{{ __('countries.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $countries->links() }}
@stop
