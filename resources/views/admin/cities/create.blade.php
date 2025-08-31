@extends('adminlte::page')

@section('title', __('cities.create'))

@section('content_header')
    <h1>{{ __('cities.create') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.cities.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="country_id">{{ __('cities.country') }}</label>
            <select name="country_id" id="country_id" class="form-control" required>
                <option value="">{{ __('cities.select_country') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">
                        {{ $country->getTranslation('name', app()->getLocale()) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('cities.translations') }}</label>
            <ul class="nav nav-tabs" role="tablist">
                @foreach ($languages as $language)
                    <li class="nav-item">
                        <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#tab_{{ $language->code }}" role="tab">
                            {{ $language->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content mt-2">
                @foreach ($languages as $language)
                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="tab_{{ $language->code }}" role="tabpanel">
                        <div class="form-group">
                            <label for="name_{{ $language->code }}">{{ __('cities.name') }}</label>
                            <input type="text" name="name[{{ $language->code }}]" id="name_{{ $language->code }}" class="form-control" value="{{ old('name.' . $language->code) }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="is_active" id="is_active" checked>
            <label class="form-check-label" for="is_active">{{ __('cities.active') }}</label>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('cities.save') }}</button>
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">{{ __('cities.cancel') }}</a>
    </form>
@stop
