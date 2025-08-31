@extends('adminlte::page')

@section('title', __('property_images.add_image'))

@section('content_header')
    <h1>{{ __('property_images.add_image') }}</h1>
    <a href="{{ route('admin.property_images.index') }}" class="btn btn-secondary mb-2">{{ __('property_images.back') }}</a>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.property_images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>{{ __('property_images.property') }}</label>
            <select name="property_id" class="form-control" required>
                <option value="">{{ __('property_images.select_property') }}</option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                        {{ $property->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('property_images.image') }}</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="form-group">
            <label>{{ __('property_images.description') }}</label>
            <ul class="nav nav-tabs" role="tablist">
                @foreach($activeLanguages as $key => $lang)
                    <li class="nav-item">
                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#desc-{{ $lang }}">{{ strtoupper($lang) }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content mt-2">
                @foreach($activeLanguages as $key => $lang)
                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="desc-{{ $lang }}">
                        <textarea name="description[{{ $lang }}]" class="form-control" rows="3">{{ old("description.$lang") }}</textarea>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">{{ __('property_images.save') }}</button>
    </form>
@stop
