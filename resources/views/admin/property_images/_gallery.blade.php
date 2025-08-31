@if($property->images->count())
    <div id="image-gallery" class="row">
        @foreach($property->images->sortBy('position') as $image)
            <div class="col-md-3 mb-3 image-item" data-id="{{ $image->id }}">
                <div class="card">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Property Image">
                    <div class="card-body">
                        <form action="{{ route('properties.images.update', [$property, $image]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @foreach(config('app.locales') as $locale => $label)
                                <div class="form-group">
                                    <label>{{ __('general.description') }} ({{ strtoupper($locale) }})</label>
                                    <input type="text" name="translations[{{ $locale }}][description]" class="form-control"
                                           value="{{ old("translations.$locale.description", $image->getTranslation('description', $locale)) }}">
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary mt-1" type="submit">
                                {{ __('buttons.save') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('properties.images.destroy', [$property, $image]) }}" class="mt-2 delete-image-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100 delete-image-btn" type="submit">{{ __('buttons.delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $('#image-gallery').sortable({
        update: function () {
            let order = $(this).children().map(function () {
                return $(this).data('id');
            }).get();

            $.post('{{ route('properties.images.reorder') }}', {
                order: order,
                _token: '{{ csrf_token() }}'
            });
        }
    });

    $('.delete-image-form').on('submit', function (e) {
        e.preventDefault();
        if (confirm('{{ __("messages.confirm_delete") }}')) {
            let form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function () {
                    form.closest('.image-item').remove();
                }
            });
        }
    });
</script>
@endpush
