@extends('adminlte::page')

@section('title', __('districts.edit'))

@section('content_header')
    <h1>{{ __('districts.edit') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.districts.update', $district) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="city_id">{{ __('districts.city') }}</label>
            <select name="city_id" class="form-control" required>
                <option value="">{{ __('districts.select_city') }}</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" @selected($district->city_id == $city->id)>
                        {{ $city->getTranslatedAttribute('name') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('districts.translations') }}</label>
            <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $lang)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#lang-{{ $lang->code }}">{{ $lang->name }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-2">
                @foreach($languages as $lang)
                    <div id="lang-{{ $lang->code }}" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}">
                        <div class="form-group">
                            <label>{{ __('districts.name') }} ({{ $lang->code }})</label>
                            <input type="text" name="translations[{{ $lang->code }}][name]" class="form-control"
                                value="{{ $district->getTranslatedAttribute('name', $lang->code) }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" @checked($district->is_active)>
            <label for="is_active" class="form-check-label">{{ __('districts.is_active') }}</label>
        </div>

        <button class="btn btn-primary">{{ __('districts.save') }}</button>
    </form>
@stop
