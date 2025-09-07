{{-- resources/views/admin/pages/partials/form.blade.php --}}

<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="seo_title" class="form-label">SEO Title</label>
    <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $page->seo_title ?? '') }}">
</div>

<div class="mb-3">
    <label for="seo_description" class="form-label">SEO Description</label>
    <input type="text" name="seo_description" class="form-control" value="{{ old('seo_description', $page->seo_description ?? '') }}">
</div>

<div class="mb-3">
    <label for="meta_keywords" class="form-label">Meta Keywords</label>
    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}">
</div>

<div class="mb-3">
    <label for="template" class="form-label">Template</label>
    <input type="text" name="template" class="form-control" value="{{ old('template', $page->template ?? '') }}">
</div>

<div class="mb-3">
    <label for="sort_order" class="form-label">Подредба</label>
    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $page->sort_order ?? 0) }}">
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="is_active" class="form-check-input" value="1"
           {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Активна</label>
</div>

<hr>

{{-- Езикови табове --}}
<ul class="nav nav-tabs" id="langTabs" role="tablist">
    @foreach ($languages as $language)
        <li class="nav-item" role="presentation">
            <a class="nav-link @if ($loop->first) active @endif"
               id="tab-{{ $language->code }}"
               data-toggle="tab"
               href="#content-{{ $language->code }}"
               role="tab">
                {{ $language->name }}
            </a>
        </li>
    @endforeach
</ul>

<div class="tab-content mt-3">
    @foreach ($languages as $language)
        <div class="tab-pane fade @if ($loop->first) show active @endif"
             id="content-{{ $language->code }}"
             role="tabpanel">

            <div class="mb-3">
                <label class="form-label">Заглавие</label>
                <input type="text" name="translations[{{ $language->code }}][title]" class="form-control"
                       value="{{ old("translations.{$language->code}.title", $page?->getTranslation('title', $language->code)) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Кратко описание</label>
                <textarea name="translations[{{ $language->code }}][excerpt]" class="form-control ckeditor">
                    {{ old("translations.{$language->code}.excerpt", $page?->getTranslation('excerpt', $language->code)) }}
                </textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Съдържание</label>
                <textarea name="translations[{{ $language->code }}][content]" class="form-control ckeditor">
                    {{ old("translations.{$language->code}.content", $page?->getTranslation('content', $language->code)) }}
                </textarea>
            </div>

        </div>
    @endforeach
</div>

{{-- CKEditor 4 + Laravel FileManager --}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('textarea.ckeditor').forEach(function (el) {
            CKEDITOR.replace(el, {
                filebrowserBrowseUrl: '{{ url("/laravel-filemanager?type=Files") }}',
                filebrowserImageBrowseUrl: '{{ url("/laravel-filemanager?type=Images") }}',
                filebrowserUploadUrl: '{{ url("/laravel-filemanager/upload?type=Files&_token=" . csrf_token()) }}',
                filebrowserImageUploadUrl: '{{ url("/laravel-filemanager/upload?type=Images&_token=" . csrf_token()) }}'
            });
        });
    });
</script>
