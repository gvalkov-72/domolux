@extends('adminlte::page')

@section('title', __('countries.create'))

@section('content_header')
    <h1>{{ __('countries.create') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.countries.store') }}" method="POST">
        @csrf

        <x-adminlte-input name="code" label="{{ __('countries.code') }}" required />

        <x-adminlte-input-switch name="is_active" label="{{ __('countries.active') }}" data-on-text="Да" data-off-text="Не" checked />

        <x-adminlte-card title="{{ __('countries.translations') }}" theme="lightblue">
            <ul class="nav nav-tabs" id="langTabs" role="tablist">
                @foreach($languages as $index => $language)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link @if($index === 0) active @endif"
                           id="tab-{{ $language->code }}"
                           data-toggle="tab"
                           href="#locale-{{ $language->code }}"
                           role="tab">
                            {{ $language->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-3">
                @foreach($languages as $index => $language)
                    <div class="tab-pane fade @if($index === 0) show active @endif"
                         id="locale-{{ $language->code }}"
                         role="tabpanel">
                        <x-adminlte-input name="translations[{{ $language->code }}][name]"
                                          label="{{ __('countries.name') }}"
                                          value=""
                        />
                    </div>
                @endforeach
            </div>
        </x-adminlte-card>

        <x-adminlte-button type="submit" label="{{ __('countries.save') }}" theme="success" />
    </form>
@stop
