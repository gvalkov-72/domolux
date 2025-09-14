<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label">Тип (template)</label>
        <input type="text" name="type" class="form-control" value="{{ old('type', $section->type ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Key (slug)</label>
        <input type="text" name="key" class="form-control" value="{{ old('key', $section->key ?? '') }}">
    </div>

    <div class="col-md-2">
        <label class="form-label">Позиция</label>
        <input type="number" name="position" class="form-control" value="{{ old('position', $section->position ?? 0) }}">
    </div>

    <div class="col-md-2">
        <label class="form-label">Активна</label>
        <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Да</label>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Настройки (JSON)</label>
    <textarea name="settings" class="form-control" rows="3">{{ old('settings', isset($section) ? (is_array($section->settings) ? json_encode($section->settings, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) : $section->settings) : '') }}</textarea>
</div>

<hr>

<div class="row">
    @foreach ($languages as $language)
        @php $colClass = $languages->count() === 1 ? 'col-md-12' : 'col-md-6'; @endphp
        <div class="{{ $colClass }} mb-4">
            <div class="border p-3 rounded h-100">
                <h5>{{ $language->name }} ({{ $language->code }})</h5>

                <div class="mb-3">
                    <label class="form-label">Заглавие</label>
                    <input type="text" name="translations[{{ $language->code }}][title]" class="form-control"
                           value="{{ old("translations.{$language->code}.title", $section?->getTranslation('title', $language->code)) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Кратко описание</label>
                    <textarea name="translations[{{ $language->code }}][excerpt]" class="form-control" rows="2">{{ old("translations.{$language->code}.excerpt", $section?->getTranslation('excerpt', $language->code)) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Съдържание (HTML)</label>
                    <textarea name="translations[{{ $language->code }}][content]" class="form-control" rows="5">{{ old("translations.{$language->code}.content", $section?->getTranslation('content', $language->code)) }}</textarea>
                </div>
            </div>
        </div>
    @endforeach
</div>
