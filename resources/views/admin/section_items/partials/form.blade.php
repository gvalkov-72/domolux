<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Секция</label>
        <select name="section_id" class="form-control" required>
            <option value="">-- избери --</option>
            @foreach($sections as $s)
                <option value="{{ $s->id }}" {{ old('section_id', $sectionItem->section_id ?? request('section_id')) == $s->id ? 'selected' : '' }}>
                    {{ $s->type }} {{ $s->key ? '(' . $s->key . ')' : '' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Позиция</label>
        <input type="number" name="position" class="form-control" value="{{ old('position', $sectionItem->position ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Активен</label>
        <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', $sectionItem->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Да</label>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">URL / Link</label>
    <input type="text" name="url" class="form-control" value="{{ old('url', $sectionItem->url ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Изображение</label>
    <input type="file" name="image" class="form-control">
    @if(!empty($sectionItem->image))
        <div class="mt-2">
            <img src="{{ asset('storage/'.$sectionItem->image) }}" style="max-width:200px">
        </div>
    @endif
</div>

<hr>

<div class="row">
    @foreach ($languages as $language)
        @php $colClass = $languages->count() === 1 ? 'col-md-12' : 'col-md-6'; @endphp
        <div class="{{ $colClass }} mb-4">
            <div class="border p-3 rounded h-100">
                <h5>{{ $language->name }}</h5>

                <div class="mb-3">
                    <label class="form-label">Заглавие</label>
                    <input type="text" name="translations[{{ $language->code }}][title]" class="form-control"
                           value="{{ old("translations.{$language->code}.title", $sectionItem?->getTranslation('title', $language->code)) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Подзаглавие</label>
                    <input type="text" name="translations[{{ $language->code }}][subtitle]" class="form-control"
                           value="{{ old("translations.{$language->code}.subtitle", $sectionItem?->getTranslation('subtitle', $language->code)) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Кратко описание</label>
                    <textarea name="translations[{{ $language->code }}][content]" class="form-control" rows="3">{{ old("translations.{$language->code}.content", $sectionItem?->getTranslation('content', $language->code)) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Текст на бутон</label>
                    <input type="text" name="translations[{{ $language->code }}][button_text]" class="form-control"
                           value="{{ old("translations.{$language->code}.button_text", $sectionItem?->getTranslation('button_text', $language->code)) }}">
                </div>
            </div>
        </div>
    @endforeach
</div>
