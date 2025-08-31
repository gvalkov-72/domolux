@extends('adminlte::page')

@section('title', __('countries.edit'))

@section('content_header')
    <h1>{{ __('countries.edit') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.countries.update', $country) }}" method="POST">
        @csrf
        @method('PUT')

        <x-adminlte-input name="code" label="{{ __('countries.code') }}" value="{{ $country->code }}" required />

        <x-adminlte-input-switch name="is_active" label="{{ __('countries.active') }}"
                                 data-on-text="Да" data-off-text="Не"
                                 :checked="$country->is_active" />

        <x-adminlte-card title="{{ __('countries.translations') }}" theme="lightblue">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $index => $language)
                    <li class="nav-item">
                        <a class="nav-link @if($index === 0) active @endif"
                           data-toggle="tab"
                           href="#lang-{{ $language->code }}">
                            {{ $language->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-3">
                @foreach($languages as $index => $language)
                    <div class="tab-pane fade @if($index === 0) show active @endif"
                         id="lang-{{ $language->code }}">
                        <x-adminlte-input name="translations[{{ $language->code }}][name]"
                                          label="{{ __('countries.name') }}"
                                          value="{{ old('translations.' . $language->code . '.name', $country->getTranslation('name', $language->code)) }}"
                        />
                    </div>
                @endforeach
            </div>
        </x-adminlte-card>

        <x-adminlte-button type="submit" label="{{ __('countries.save') }}" theme="primary" />
    </form>
@stop
