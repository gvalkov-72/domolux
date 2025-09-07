{{-- resources/views/admin/pages/partials/form.blade.php --}}

<div class="row mb-3">
    <div class="col-md-6">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label for="seo_title" class="form-label">SEO Title</label>
        <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $page->seo_title ?? '') }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="seo_description" class="form-label">SEO Description</label>
        <input type="text" name="seo_description" class="form-control" value="{{ old('seo_description', $page->seo_description ?? '') }}">
    </div>
    <div class="col-md-6">
        <label for="meta_keywords" class="form-label">Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="template" class="form-label">Template</label>
        <input type="text" name="template" class="form-control" value="{{ old('template', $page->template ?? '') }}">
    </div>
    <div class="col-md-6">
        <label for="sort_order" class="form-label">Подредба</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $page->sort_order ?? 0) }}">
    </div>
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="is_active" class="form-check-input" value="1"
           {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Активна</label>
</div>

<hr>

{{-- Езикови секции --}}
<div class="row">
@foreach ($languages as $index => $language)
    @php
        $colClass = $languages->count() === 1 ? 'col-md-12' : 'col-md-6';
    @endphp
    <div class="{{ $colClass }} mb-4">
        <div class="border p-3 rounded h-100">
            <h5>{{ $language->name }}</h5>

            <div class="mb-3">
                <label class="form-label">Заглавие</label>
                <input type="text" name="translations[{{ $language->code }}][title]" class="form-control"
                       value="{{ old("translations.{$language->code}.title", $page?->getTranslation('title', $language->code)) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Кратко описание</label>
                <textarea id="excerpt-{{ $language->code }}" name="translations[{{ $language->code }}][excerpt]" class="form-control ckeditor">{{ old("translations.{$language->code}.excerpt", $page?->getTranslation('excerpt', $language->code)) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Съдържание</label>
                <textarea id="content-{{ $language->code }}" name="translations[{{ $language->code }}][content]" class="form-control ckeditor">{{ old("translations.{$language->code}.content", $page?->getTranslation('content', $language->code)) }}</textarea>
            </div>
        </div>
    </div>
@endforeach
</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ckEditors = {};

    function initCKEditor(textarea) {
        if (!textarea.id) {
            textarea.id = 'ckeditor-' + Math.random().toString(36).substring(2, 10);
        }
        if (CKEDITOR.instances[textarea.id]) {
            CKEDITOR.instances[textarea.id].destroy(true);
        }
        ckEditors[textarea.id] = CKEDITOR.replace(textarea.id, {
            height: 300,
            filebrowserBrowseUrl: '{{ url("admin/laravel-filemanager?type=Files") }}',
            filebrowserUploadUrl: '{{ url("admin/laravel-filemanager/upload?type=Files&_token=") }}' + '{{ csrf_token() }}',
            filebrowserImageBrowseUrl: '{{ url("admin/laravel-filemanager?type=Images") }}',
            filebrowserImageUploadUrl: '{{ url("admin/laravel-filemanager/upload?type=Images&_token=") }}' + '{{ csrf_token() }}'
        });
    }

    document.querySelectorAll('textarea.ckeditor').forEach(initCKEditor);
});
</script>
