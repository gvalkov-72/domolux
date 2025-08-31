@extends('adminlte::page')

@section('title', __('districts.title'))

@section('content_header')
    <h1>{{ __('districts.title') }}</h1>
@stop

@section('content')
    <a href="{{ route('admin.districts.create') }}" class="btn btn-primary mb-3">{{ __('districts.create') }}</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('districts.name') }}</th>
                <th>{{ __('districts.city') }}</th>
                <th>{{ __('districts.is_active') }}</th>
                <th>{{ __('districts.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($districts as $district)
                <tr>
                    <td>{{ $district->id }}</td>
                    <td>{{ $district->getTranslatedAttribute('name') }}</td>
                    <td>{{ $district->city->getTranslatedAttribute('name') }}</td>
                    <td>{{ $district->is_active ? __('districts.active') : __('districts.inactive') }}</td>
                    <td>
                        <a href="{{ route('admin.districts.edit', $district) }}" class="btn btn-sm btn-warning">{{ __('districts.edit') }}</a>
                        <form action="{{ route('admin.districts.destroy', $district) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('{{ __('districts.confirm_delete') }}')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">{{ __('districts.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $districts->links() }}
@stop
