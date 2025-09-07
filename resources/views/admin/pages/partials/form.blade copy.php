{{-- resources/views/admin/pages/partials/form.blade.php --}}
<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control" id="slug"
           value="{{ old('slug', $page->slug ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="seo_title" class="form-label">SEO Title</label>
    <input type="text" name="seo_title" class="form-control" id="seo_title"
           value="{{ old('seo_title', $page->seo_title ?? '') }}">
</div>

<div class="mb-3">
    <label for="seo_description" class="form-label">SEO Description</label>
    <input type="text" name="seo_description" class="form-control" id="seo_description"
           value="{{ old('seo_description', $page->seo_description ?? '') }}">
</div>

<div class="mb-3">
    <label for="meta_keywords" class="form-label">Meta Keywords</label>
    <input type="text" name="meta_keywords" class="form-control" id="meta_keywords"
           value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}">
</div>

<div class="mb-3">
    <label for="template" class="form-label">Template</label>
    <input type="text" name="template" class="form-control" id="template"
           value="{{ old('template', $page->template ?? '') }}">
</div>

<div class="mb-3">
    <label for="sort_order" class="form-label">Подредба</label>
    <input type="number" name="sort_order" class="form-control" id="sort_order"
           value="{{ old('sort_order', $page->sort_order ?? 0) }}">
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1"
           {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Активна</label>
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
                <label class="form-label" for="title-{{ $language->code }}">Заглавие</label>
                <input type="text" id="title-{{ $language->code }}"
                       name="translations[{{ $language->code }}][title]" class="form-control"
                       value="{{ old("translations.{$language->code}.title", $page?->getTranslation('title', $language->code)) }}">
            </div>

            <div class="mb-3">
                <label class="form-label" for="excerpt-{{ $language->code }}">Кратко описание</label>
                <textarea id="excerpt-{{ $language->code }}"
                          name="translations[{{ $language->code }}][excerpt]"
                          class="form-control ckeditor">{{ old("translations.{$language->code}.excerpt", $page?->getTranslation('excerpt', $language->code)) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="content-{{ $language->code }}">Съдържание</label>
                <textarea id="content-{{ $language->code }}"
                          name="translations[{{ $language->code }}][content]"
                          class="form-control ckeditor">{{ old("translations.{$language->code}.content", $page?->getTranslation('content', $language->code)) }}</textarea>
            </div>

        </div>
    @endforeach
</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const ckEditors = {};
    let currentEditor = null;

    const lfmRoute = '{{ url("admin/laravel-filemanager") }}';
    const csrfToken = '{{ csrf_token() }}';

    function openFileManager(type = 'Images') {
        const url = lfmRoute + '?type=' + type;
        window.open(url, 'FileManager', 'width=900,height=600');
    }

    window.SetUrl = function (items) {
        if (!items || !items.length) return;
        const url = items[0].url || items[0].thumb_url || items[0].name;

        try {
            const dialog = CKEDITOR.dialog.getCurrent && CKEDITOR.dialog.getCurrent();
            if (dialog) {
                const infoUrl = dialog.getContentElement('info', 'txtUrl') ||
                                dialog.getContentElement('info', 'src') ||
                                dialog.getContentElement('info', 'url');
                if (infoUrl) {
                    infoUrl.setValue(url);
                    const preview = dialog.getContentElement('info', 'htmlPreview') ||
                                    dialog.getContentElement('info', 'preview');
                    if (preview && preview.getElement) {
                        preview.getElement().setHtml('<img src="' + url + '" style="max-width:100%;"/>');
                    }
                    return;
                }
            }
        } catch (err) {
            console.warn('Не успях да попълня диалога на CKEditor:', err);
        }

        if (currentEditor) {
            currentEditor.insertHtml('<img src="' + url + '" alt="" />');
        }
    };

    function initCKEditorOnce(textarea) {
        if (!textarea.id) {
            textarea.id = 'ckeditor-' + Math.random().toString(36).substring(2, 10);
        }
        if (!CKEDITOR.instances[textarea.id]) {
            const editor = CKEDITOR.replace(textarea.id, {
                height: 400,
                filebrowserBrowseUrl: lfmRoute + '?type=Files',
                filebrowserImageBrowseUrl: lfmRoute + '?type=Images',
                filebrowserUploadUrl: lfmRoute + '/upload?type=Files&_token=' + csrfToken,
                filebrowserImageUploadUrl: lfmRoute + '/upload?type=Images&_token=' + csrfToken,
                extraPlugins: 'image2,uploadimage',
                toolbar: [
                    { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo'] },
                    { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
                    { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
                    { name: 'links', items: ['Link', 'Unlink'] },
                    { name: 'tools', items: ['Maximize'] },
                    { name: 'document', items: ['Source'] }
                ]
            });

            editor.on('instanceReady', function () {
                editor.on('focus', function () {
                    currentEditor = editor;
                });
            });

            ckEditors[textarea.id] = editor;
        }
    }

    const firstTab = document.querySelector('.tab-pane.active');
    if (firstTab) {
        firstTab.querySelectorAll('textarea.ckeditor').forEach(initCKEditorOnce);
    }

    document.querySelectorAll('a[data-toggle="tab"]').forEach(tabLink => {
        tabLink.addEventListener('shown.bs.tab', function(e) {
            const targetId = e.target.getAttribute('href');
            const activeTab = document.querySelector(targetId);
            if (activeTab) {
                activeTab.querySelectorAll('textarea.ckeditor').forEach(initCKEditorOnce);
            }
        });
    });

});
</script>
