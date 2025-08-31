@extends('adminlte::page')

@section('title', __('properties.show'))

@section('content_header')
    <h1>{{ __('properties.show') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>{{ $property->getTranslation('name') }}</h4>

            <p><strong>{{ __('properties.location') }}:</strong> {{ $property->location?->getTranslation('name') }}</p>
            <p><strong>{{ __('properties.property_type') }}:</strong> {{ $property->type?->getTranslation('name') }}</p>

            <p><strong>{{ __('properties.extras') }}:</strong>
                @foreach($property->extras as $extra)
                    <span class="badge badge-info">{{ $extra->getTranslation('name') }}</span>
                @endforeach
            </p>

            <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> {{ __('properties.edit') }}
            </a>
        </div>
    </div>
@stop
