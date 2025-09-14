{{-- resources/views/admin/properties/form.blade.php --}}
@php
    $locales = config('app.locales', ['bg' => 'Български']); // активните езици
@endphp

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-home"></i>
            {{ $property->exists ? __('Редактиране на имот') : __('Създаване на имот') }}
        </h3>
    </div>

    <div class="card-body">
        {{-- Навигация за езици --}}
        <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
            @foreach($locales as $locale => $label)
                <li class="nav-item">
                    <a class="nav-link @if($loop->first) active @endif" id="tab-{{ $locale }}" data-toggle="tab" href="#locale-{{ $locale }}" role="tab">
                        <i class="fas fa-language"></i> {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Съдържание на табовете --}}
        <div class="tab-content" id="langTabsContent">
            @foreach($locales as $locale => $label)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="locale-{{ $locale }}" role="tabpanel">
                    <div class="form-group">
                        <label for="title_{{ $locale }}">{{ __('Заглавие') }} ({{ $label }})</label>
                        <input type="text" name="title[{{ $locale }}]" id="title_{{ $locale }}"
                               class="form-control @error("title.$locale") is-invalid @enderror"
                               value="{{ old("title.$locale", $property->translateOrNew($locale)->title) }}">
                        @error("title.$locale")
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description_{{ $locale }}">{{ __('Описание') }} ({{ $label }})</label>
                        <textarea name="description[{{ $locale }}]" id="description_{{ $locale }}"
                                  class="form-control @error("description.$locale") is-invalid @enderror" rows="4">{{ old("description.$locale", $property->translateOrNew($locale)->description) }}</textarea>
                        @error("description.$locale")
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        {{-- Непреводими полета --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="code">{{ __('Код на обявата') }}</label>
                    <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $property->code) }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="position">{{ __('Позиция') }}</label>
                    <input type="number" name="position" id="position" class="form-control" value="{{ old('position', $property->position) }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="price_bgn">{{ __('Цена (лв.)') }}</label>
                    <input type="number" step="0.01" name="price_bgn" id="price_bgn" class="form-control" value="{{ old('price_bgn', $property->price_bgn) }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="price_eur">{{ __('Цена (евро)') }}</label>
                    <input type="number" step="0.01" name="price_eur" id="price_eur" class="form-control" value="{{ old('price_eur', $property->price_eur) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="property_type_id">{{ __('Тип имот') }}</label>
                    <select name="property_type_id" id="property_type_id" class="form-control">
                        <option value="">{{ __('-- Избери --') }}</option>
                        @foreach($propertyTypes as $type)
                            <option value="{{ $type->id }}" @selected(old('property_type_id', $property->property_type_id) == $type->id)>
                                {{ $type->translate(app()->getLocale())->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="country_id">{{ __('Държава') }}</label>
                    <select name="country_id" id="country_id" class="form-control">
                        <option value="">{{ __('-- Избери --') }}</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" @selected(old('country_id', $property->country_id) == $country->id)>
                                {{ $country->translate(app()->getLocale())->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="city_id">{{ __('Град') }}</label>
                    <select name="city_id" id="city_id" class="form-control">
                        <option value="">{{ __('-- Избери --') }}</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" @selected(old('city_id', $property->city_id) == $city->id)>
                                {{ $city->translate(app()->getLocale())->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="district_id">{{ __('Квартал') }}</label>
                    <select name="district_id" id="district_id" class="form-control">
                        <option value="">{{ __('-- Избери --') }}</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" @selected(old('district_id', $property->district_id) == $district->id)>
                                {{ $district->translate(app()->getLocale())->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Локация и екстри --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location_id">{{ __('Локация') }}</label>
                    <select name="location_id" id="location_id" class="form-control">
                        <option value="">{{ __('-- Избери --') }}</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" @selected(old('location_id', $property->location_id) == $location->id)>
                                {{ $location->translate(app()->getLocale())->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ __('Екстри') }}</label>
                <div class="form-group">
                    @foreach($extras as $extra)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="extra_{{ $extra->id }}"
                                   name="extras[]"
                                   value="{{ $extra->id }}"
                                   @checked(in_array($extra->id, old('extras', $property->extras->pluck('id')->toArray() ?? [])))>
                            <label class="form-check-label" for="extra_{{ $extra->id }}">
                                {{ $extra->translate(app()->getLocale())->name ?? '' }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Активност и дати --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="is_active">{{ __('Активен') }}</label><br>
                    <input type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $property->is_active))>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="active_from">{{ __('Начална дата/час') }}</label>
                    <input type="datetime-local" name="active_from" id="active_from" class="form-control"
                           value="{{ old('active_from', optional($property->active_from)->format('Y-m-d\TH:i')) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="active_to">{{ __('Крайна дата/час') }}</label>
                    <input type="datetime-local" name="active_to" id="active_to" class="form-control"
                           value="{{ old('active_to', optional($property->active_to)->format('Y-m-d\TH:i')) }}">
                </div>
            </div>
        </div>
    </div>
</div>
