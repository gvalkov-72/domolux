@extends('adminlte::page')

@section('title', __('properties.title'))

@section('content_header')
    <h1>{{ __('properties.title') }}</h1>
    <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">{{ __('properties.create') }}</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('properties.code') }}</th>
            <th>{{ __('properties.title_label') }}</th>
            <th>{{ __('properties.price') }}</th>
            <th>{{ __('properties.offer_type') }}</th>
            <th>{{ __('properties.property_type') }}</th>
            <th>{{ __('properties.city') }}</th>
            <th>{{ __('properties.district') }}</th>
            <th>{{ __('properties.location') }}</th>
            <th>{{ __('properties.extras') }}</th>
            <th>{{ __('properties.is_active') }}</th>
            <th>{{ __('properties.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($properties as $property)
            <tr>
                <td>{{ $property->id }}</td>
                <td>{{ $property->code }}</td>
                <td>{{ $property->getTranslation('title', app()->getLocale()) }}</td>
                <td>{{ number_format($property->price, 2, ',', ' ') }}</td>
                <td>{{ $property->getTranslation('offer_type', app()->getLocale()) }}</td>
                <td>{{ $property->propertyType->getTranslation('name', app()->getLocale()) }}</td>
                <td>{{ $property->city->getTranslation('name', app()->getLocale()) }}</td>
                <td>{{ optional($property->district)->getTranslation('name', app()->getLocale()) }}</td>
                <td>{{ optional($property->location)->getTranslation('name', app()->getLocale()) }}</td>
                <td>
                    @foreach($property->extras as $extra)
                        <span class="badge badge-info">{{ $extra->getTranslation('name', app()->getLocale()) }}</span>
                    @endforeach
                </td>
                <td>
                    @if($property->is_active)
                        <span class="badge badge-success">{{ __('properties.active') }}</span>
                    @else
                        <span class="badge badge-danger">{{ __('properties.inactive') }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-warning btn-sm">{{ __('properties.edit') }}</a>
                    <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('{{ __('properties.confirm_delete') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">{{ __('properties.delete') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $properties->links() }}
@stop
