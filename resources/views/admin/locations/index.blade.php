@extends('adminlte::page')

@section('title', __('locations.title'))

@section('content_header')
    <h1>{{ __('locations.title') }}</h1>
@stop

@section('content')
    <a href="{{ route('admin.locations.create') }}" class="btn btn-success mb-3">
        {{ __('locations.create') }}
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('locations.name') }}</th>
                <th>{{ __('locations.district') }}</th>
                <th>{{ __('locations.active') }}</th>
                <th>{{ __('locations.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->getTranslatedAttribute('name') }}</td>
                    <td>{{ $location->district?->getTranslatedAttribute('name') }}</td>
                    <td>
                        @if($location->is_active)
                            <span class="badge bg-success">{{ __('locations.active') }}</span>
                        @else
                            <span class="badge bg-danger">{{ __('locations.inactive') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.locations.edit', $location) }}" class="btn btn-primary btn-sm">
                            {{ __('locations.edit') }}
                        </a>
                        <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('{{ __('locations.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">{{ __('locations.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
