<div class="form-group">
    <label for="code">{{ __('admin.code') }}</label>
    <input type="text" name="code" class="form-control" value="{{ old('code', $country->code ?? '') }}" required>
</div>

<div class="form-group">
    <label>
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $country->is_active ?? true) ? 'checked' : '' }}>
        {{ __('admin.active') }}
    </label>
</div>

<ul class="nav nav-tabs" role="tablist">
    @foreach ($languages as $lang)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#tab_{{ $lang->code }}">
                {{ strtoupper($lang->code) }}
            </a>
        </li>
    @endforeach
</ul>

<div class="tab-content pt-3">
    @foreach ($languages as $lang)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab_{{ $lang->code }}">
            <div class="form-group">
                <label>{{ __('admin.name') }} ({{ strtoupper($lang->code) }})</label>
                <input type="text" class="form-control"
                    name="translations[{{ $lang->code }}][name]"
                    value="{{ old("translations.{$lang->code}.name", $country?->getTranslation('name', $lang->code)) }}">
            </div>
        </div>
    @endforeach
</div>
