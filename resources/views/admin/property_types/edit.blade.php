@extends('adminlte::page')

@section('title', __('property_types.edit'))

@section('content_header')
    <h1>{{ __('property_types.edit') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.property_types.update', $propertyType) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>{{ __('property_types.translations') }}</label>
            <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $lang)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                           data-toggle="tab" href="#lang-{{ $lang->code }}">{{ $lang->name }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-2">
                @foreach($languages as $lang)
                    <div id="lang-{{ $lang->code }}" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}">
                        <div class="form-group">
                            <label>{{ __('property_types.name') }} ({{ $lang->code }})</label>
                            <input type="text" name="translations[{{ $lang->code }}][name]"
                                   class="form-control"
                                   value="{{ $propertyType->getTranslatedAttribute('name', $lang->code) }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                   {{ $propertyType->is_active ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">{{ __('property_types.is_active') }}</label>
        </div>

        <button class="btn btn-primary">{{ __('property_types.update') }}</button>
    </form>
@stop
