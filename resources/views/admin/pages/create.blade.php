@extends('adminlte::page')

@section('title', __('pages.create_new'))

@section('content_header')
    <h1>{{ __('pages.create_new') }}</h1>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">{{ __('pages.back') }}</a>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="slug">{{ __('pages.slug') }}</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('pages.is_active') }}</label><br>
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
        </div>

        <div class="form-group">
            <label for="sort_order">{{ __('pages.sort_order') }}</label>
            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
        </div>

        <div class="form-group">
            <label for="seo_title">{{ __('pages.seo_title') }}</label>
            <input type="text" name="seo_title" id="seo_title" class="form-control" value="{{ old('seo_title') }}">
        </div>

        <div class="form-group">
            <label for="seo_description">{{ __('pages.seo_description') }}</label>
            <input type="text" name="seo_description" id="seo_description" class="form-control" value="{{ old('seo_description') }}">
        </div>

        <ul class="nav nav-tabs" id="languageTabs" role="tablist">
            @foreach($languages as $lang)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($loop->first) active @endif" id="tab-{{ $lang->code }}" data-toggle="tab" data-target="#lang-{{ $lang->code }}" type="button" role="tab" aria-controls="lang-{{ $lang->code }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ strtoupper($lang->code) }}
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="tab-content mt-3" id="languageTabsContent">
            @foreach($languages as $lang)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="lang-{{ $lang->code }}" role="tabpanel" aria-labelledby="tab-{{ $lang->code }}">
                    <div class="form-group">
                        <label for="title_{{ $lang->code }}">{{ __('pages.title') }} ({{ strtoupper($lang->code) }})</label>
                        <input type="text" name="title[{{ $lang->code }}]" id="title_{{ $lang->code }}" class="form-control" value="{{ old("title.$lang->code") }}" required>
                    </div>

                    <div class="form-group">
                        <label for="content_{{ $lang->code }}">{{ __('pages.content') }} ({{ strtoupper($lang->code) }})</label>
                        <textarea name="content[{{ $lang->code }}]" id="content_{{ $lang->code }}" class="form-control summernote" rows="6">{{ old("content.$lang->code") }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">{{ __('pages.save') }}</button>
    </form>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
    <script>
        $(function () {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
            });
        });
    </script>
@stop
