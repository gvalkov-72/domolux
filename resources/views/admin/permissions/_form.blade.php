<div class="mb-3">
    <label for="name" class="form-label">{{ __('languages.permission_name_label') }}</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $permission?->name) }}" required>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($permission) ? __('languages.update_button') : __('languages.create_button') }}
</button>

<a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">{{ __('languages.back_button') }}</a>
