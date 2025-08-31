@extends('adminlte::page')

@section('title', __('properties.create'))

@section('content_header')
    <h1>{{ __('properties.create') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card card-primary">
            <div class="card-body">

                {{-- Код на имота --}}
                <div class="form-group">
                    <label>{{ __('properties.code') }}</label>
                    <input type="text" name="code" class="form-control" required>
                </div>

                {{-- Езикови табове за преводими полета + преводими dropdowns и чекбоксове --}}
                <ul class="nav nav-tabs" role="tablist">
                    @foreach ($activeLanguages as $lang)
                        <li class="nav-item">
                            <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab"
                                href="#lang_{{ $lang->code }}">{{ strtoupper($lang->code) }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content border p-3 mb-3">
                    @foreach ($activeLanguages as $lang)
                        <div class="tab-pane fade @if ($loop->first) show active @endif"
                            id="lang_{{ $lang->code }}">

                            {{-- Заглавие --}}
                            <div class="form-group">
                                <label>{{ __('properties.title_label') }}</label>
                                <input type="text" name="title[{{ $lang->code }}]" class="form-control">
                            </div>

                            {{-- Описание --}}
                            <div class="form-group">
                                <label>{{ __('properties.description_label') }}</label>
                                <textarea name="description[{{ $lang->code }}]" class="form-control" rows="3"></textarea>
                            </div>

                            {{-- Тип оферта (преводим) --}}
                            <div class="form-group">
                                <label>{{ __('properties.offer_type_translations') }}</label>
                                <input type="text" name="offer_type[{{ $lang->code }}]" class="form-control">
                            </div>

                            {{-- Адрес (преводим) --}}
                            <div class="form-group">
                                <label>{{ __('properties.address') }}</label>
                                <input type="text" name="address[{{ $lang->code }}]" class="form-control">
                            </div>

                            {{-- Тип имот --}}
                            <div class="form-group">
                                <label>{{ __('properties.property_type') }}</label>
                                <select name="property_type_id[{{ $lang->code }}]" class="form-control" required>
                                    <option value="">{{ __('properties.select_property_type') }}</option>
                                    @foreach ($propertyTypes as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->getTranslation('name', $lang->code) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Локации --}}
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{ __('properties.country') }}</label>
                                    <select name="country_id[{{ $lang->code }}]" class="form-control" required>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->getTranslation('name', $lang->code) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('properties.city') }}</label>
                                    <select name="city_id[{{ $lang->code }}]" class="form-control" required>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">
                                                {{ $city->getTranslation('name', $lang->code) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('properties.district') }}</label>
                                    <select name="district_id[{{ $lang->code }}]" class="form-control">
                                        <option value="">{{ __('properties.optional') }}</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">
                                                {{ $district->getTranslation('name', $lang->code) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('properties.location') }}</label>
                                    <select name="location_id[{{ $lang->code }}]" class="form-control">
                                        <option value="">{{ __('properties.optional') }}</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">
                                                {{ $location->getTranslation('name', $lang->code) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Екстри - чекбоксове --}}
                            <div class="form-group">
                                <label>{{ __('properties.extras') }}</label>
                                <div class="row">
                                    @foreach ($extras as $extra)
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="extras[{{ $lang->code }}][]"
                                                    value="{{ $extra->id }}">
                                                {{ $extra->getTranslation('name', $lang->code) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- Цена --}}
                <div class="form-group">
                    <label>{{ __('properties.price') }}</label>
                    <input type="number" name="price" class="form-control" step="0.01" required>
                </div>

                {{-- Полета --}}
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>{{ __('properties.area') }}</label>
                        <input type="number" name="area" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ __('properties.rooms') }}</label>
                        <input type="number" name="rooms" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ __('properties.floor') }}</label>
                        <input type="number" name="floor" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ __('properties.phone') }}</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>

                {{-- Имейл --}}
                <div class="form-group">
                    <label>{{ __('properties.email') }}</label>
                    <input type="email" name="email" class="form-control">
                </div>

                {{-- Корица --}}
                <div class="form-group">
                    <label>{{ __('properties.cover_image') }}</label>
                    <input type="file" name="cover_image" class="form-control">
                </div>

                {{-- Активен --}}
                <div class="form-group mt-3">
                    <label>
                        <input type="checkbox" name="is_active" value="1"> {{ __('properties.is_active') }}
                    </label>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-success">{{ __('properties.save') }}</button>
        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">{{ __('properties.cancel') }}</a>
    </form>
@stop
