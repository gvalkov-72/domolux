@extends('adminlte::page')

@section('title', __('languages.create_title'))

@section('content_header')
    <h1>{{ __('languages.create_header') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.languages.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('languages.name') }}</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="code">{{ __('languages.code') }} ({{ __('languages.code_example') }})</label>
                    <input type="text" name="code" class="form-control" maxlength="5" required>
                </div>

                <div class="form-group">
                    <label for="description">{{ __('languages.description') }}</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">{{ __('languages.active_language') }}</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="is_default_admin" value="1" class="form-check-input" id="is_default_admin">
                    <label class="form-check-label" for="is_default_admin">{{ __('languages.default_admin_language') }}</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="is_default_site" value="1" class="form-check-input" id="is_default_site">
                    <label class="form-check-label" for="is_default_site">{{ __('languages.default_site_language') }}</label>
                </div>

                <button type="submit" class="btn btn-success mt-3">{{ __('languages.save') }}</button>
            </form>
        </div>
    </div>
@stop
