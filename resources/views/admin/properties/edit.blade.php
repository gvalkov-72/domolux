@extends('adminlte::page')

@section('title', __('properties.edit'))

@section('content_header')
    <h1>{{ __('properties.edit') }}</h1>
@stop

@section('content')
    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card card-primary">
            <div class="card-body">

                {{-- Код на имота --}}
                <div class="form-group">
                    <label>{{ __('properties.code') }}</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code', $property->code) }}" required>
                    @error('code')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Езикови табове за преводими полета --}}
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
                                <input type="text" name="title[{{ $lang->code }}]"
                                    class="form-control @error('title.' . $lang->code) is-invalid @enderror"
                                    value="{{ old('title.' . $lang->code, $property->getTranslation('title', $lang->code)) }}">
                                @error('title.' . $lang->code)
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Описание --}}
                            <div class="form-group">
                                <label>{{ __('properties.description_label') }}</label>
                                <textarea name="description[{{ $lang->code }}]"
                                    class="form-control @error('description.' . $lang->code) is-invalid @enderror" rows="3">{{ old('description.' . $lang->code, $property->getTranslation('description', $lang->code)) }}</textarea>
                                @error('description.' . $lang->code)
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Тип оферта (преводим dropdown) --}}
                            <div class="form-group">
                                <label>{{ __('properties.offer_type') }}</label>
                                <select name="offer_type[{{ $lang->code }}]" class="form-control" required>
                                    <option value="">{{ __('properties.select_offer_type') }}</option>
                                    <option value="sale" @if (old("offer_type.$lang->code") == 'sale') selected @endif>
                                        {{ __('properties.offer_type_sale') }}</option>
                                    <option value="rent" @if (old("offer_type.$lang->code") == 'rent') selected @endif>
                                        {{ __('properties.offer_type_rent') }}</option>
                                </select>
                            </div>


                            {{-- Адрес (преводим) --}}
                            <div class="form-group">
                                <label>{{ __('properties.address') }}</label>
                                <input type="text" name="address[{{ $lang->code }}]"
                                    class="form-control @error('address.' . $lang->code) is-invalid @enderror"
                                    value="{{ old('address.' . $lang->code, $property->getTranslation('address', $lang->code)) }}">
                                @error('address.' . $lang->code)
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Тип имот --}}
                            <div class="form-group">
                                <label>{{ __('properties.property_type') }}</label>
                                <select name="property_type_id[{{ $lang->code }}]"
                                    class="form-control @error('property_type_id.' . $lang->code) is-invalid @enderror"
                                    required>
                                    <option value="">{{ __('properties.select_property_type') }}</option>
                                    @foreach ($propertyTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('property_type_id.' . $lang->code, $property->property_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->getTranslation('name', $lang->code) }}</option>
                                    @endforeach
                                </select>
                                @error('property_type_id.' . $lang->code)
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Локации --}}
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{ __('properties.country') }}</label>
                                    <select name="country_id[{{ $lang->code }}]"
                                        class="form-control @error('country_id.' . $lang->code) is-invalid @enderror"
                                        required>
                                        <option value="">{{ __('properties.select_country') }}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ old('country_id.' . $lang->code, $property->country_id) == $country->id ? 'selected' : '' }}>
                                                {{ $country->getTranslation('name', $lang->code) }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id.' . $lang->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('properties.city') }}</label>
                                    <select name="city_id[{{ $lang->code }}]"
                                        class="form-control @error('city_id.' . $lang->code) is-invalid @enderror"
                                        required>
                                        <option value="">{{ __('properties.select_city') }}</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('city_id.' . $lang->code, $property->city_id) == $city->id ? 'selected' : '' }}>
                                                {{ $city->getTranslation('name', $lang->code) }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id.' . $lang->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('properties.district') }}</label>
                                    <select name="district_id[{{ $lang->code }}]"
                                        class="form-control @error('district_id.' . $lang->code) is-invalid @enderror">
                                        <option value="">{{ __('properties.optional') }}</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ old('district_id.' . $lang->code, $property->district_id) == $district->id ? 'selected' : '' }}>
                                                {{ $district->getTranslation('name', $lang->code) }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id.' . $lang->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('properties.location') }}</label>
                                    <select name="location_id[{{ $lang->code }}]"
                                        class="form-control @error('location_id.' . $lang->code) is-invalid @enderror">
                                        <option value="">{{ __('properties.optional') }}</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}"
                                                {{ old('location_id.' . $lang->code, $property->location_id) == $location->id ? 'selected' : '' }}>
                                                {{ $location->getTranslation('name', $lang->code) }}</option>
                                        @endforeach
                                    </select>
                                    @error('location_id.' . $lang->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
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
                                                    value="{{ $extra->id }}"
                                                    {{ (is_array(old('extras.' . $lang->code)) && in_array($extra->id, old('extras.' . $lang->code))) || (!$errors->any() && $property->extras->contains($extra->id)) ? 'checked' : '' }}>
                                                {{ $extra->getTranslation('name', $lang->code) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('extras.' . $lang->code)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- Цена --}}
                <div class="form-group">
                    <label>{{ __('properties.price') }}</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                        step="0.01" value="{{ old('price', $property->price) }}" required>
                    @error('price')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Полета --}}
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>{{ __('properties.area') }}</label>
                        <input type="number" name="area" class="form-control @error('area') is-invalid @enderror"
                            value="{{ old('area', $property->area) }}">
                        @error('area')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ __('properties.rooms') }}</label>
                        <input type="number" name="rooms" class="form-control @error('rooms') is-invalid @enderror"
                            value="{{ old('rooms', $property->rooms) }}">
                        @error('rooms')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ __('properties.floor') }}</label>
                        <input type="number" name="floor" class="form-control @error('floor') is-invalid @enderror"
                            value="{{ old('floor', $property->floor) }}">
                        @error('floor')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ __('properties.phone') }}</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $property->phone) }}">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Имейл --}}
                <div class="form-group">
                    <label>{{ __('properties.email') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $property->email) }}">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Корица --}}
                <div class="form-group">
                    <label>{{ __('properties.cover_image') }}</label>
                    <input type="file" name="cover_image"
                        class="form-control @error('cover_image') is-invalid @enderror">
                    @error('cover_image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    @if ($property->cover_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $property->cover_image) }}" alt="Cover Image"
                                style="max-height:150px;">
                        </div>
                    @endif
                </div>

                {{-- Активен --}}
                <div class="form-group mt-3">
                    <label>
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $property->is_active) ? 'checked' : '' }}>
                        {{ __('properties.is_active') }}
                    </label>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-success">{{ __('properties.save') }}</button>
        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">{{ __('properties.cancel') }}</a>
    </form>
@stop
