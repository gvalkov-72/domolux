@extends('adminlte::page')

@section('title', __('property_types.title'))

@section('content_header')
    <h1>{{ __('property_types.title') }}</h1>
@stop

@section('content')
    <a href="{{ route('admin.property_types.create') }}" class="btn btn-primary mb-3">
        {{ __('property_types.create') }}
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('property_types.name') }}</th>
                <th>{{ __('property_types.is_active') }}</th>
                <th>{{ __('property_types.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($propertyTypes as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->getTranslatedAttribute('name') }}</td>
                    <td>
                        @if($type->is_active)
                            <span class="badge badge-success">{{ __('property_types.active') }}</span>
                        @else
                            <span class="badge badge-danger">{{ __('property_types.inactive') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.property_types.edit', $type) }}" class="btn btn-sm btn-warning">
                            {{ __('property_types.edit') }}
                        </a>
                        <form action="{{ route('admin.property_types.destroy', $type) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('property_types.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">{{ __('property_types.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $propertyTypes->links() }}
@stop
