@extends('adminlte::page')

@section('title', __('locations.edit'))

@section('content_header')
    <h1>{{ __('locations.edit') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.locations.update', $location) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="district_id">{{ __('locations.district') }}</label>
            <select name="district_id" class="form-control" required>
                <option value="">{{ __('locations.select_district') }}</option>
                @foreach($districts as $district)
                    <option value="{{ $district->id }}" {{ $district->id == $location->district_id ? 'selected' : '' }}>
                        {{ $district->getTranslatedAttribute('name') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('locations.translations') }}</label>
            <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $lang)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#lang-{{ $lang->code }}">
                            {{ $lang->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-2">
                @foreach($languages as $lang)
                    <div id="lang-{{ $lang->code }}" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}">
                        <div class="form-group">
                            <label>{{ __('locations.name') }} ({{ $lang->code }})</label>
                            <input type="text" name="translations[{{ $lang->code }}][name]"
                                   value="{{ $location->getTranslatedAttribute('name', $lang->code) }}"
                                   class="form-control">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                   {{ $location->is_active ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">{{ __('locations.is_active') }}</label>
        </div>

        <button class="btn btn-primary">{{ __('locations.update') }}</button>
    </form>
@stop
