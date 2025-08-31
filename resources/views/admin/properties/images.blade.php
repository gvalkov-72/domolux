<div class="card mt-4">
    <div class="card-header">{{ __('Имoтни снимки') }}</div>
    <div class="card-body">
        <form action="{{ route('admin.properties.images.store', $property) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ __('Качи нови снимки') }}</label>
                <input type="file" name="images[]" multiple class="form-control @error('images') is-invalid @enderror">
                @error('images') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Качи') }}</button>
        </form>

        @if($property->images->count())
            <hr>
            <div id="sortable-images" class="row mt-4">
                @foreach($property->images->sortBy('position') as $image)
                    <div class="col-md-3 mb-3 image-item" data-id="{{ $image->id }}">
                        <div class="card">
                            <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top" alt="">
                            <div class="card-body text-center p-2">
                                <button class="btn btn-sm btn-danger delete-image" data-id="{{ $image->id }}">
                                    {{ __('Изтрий') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@push('js')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(function () {
        $('#sortable-images').sortable({
            update: function (event, ui) {
                let positions = {};
                $('.image-item').each(function (index) {
                    positions[$(this).data('id')] = index;
                });

                $.post("{{ route('admin.properties.images.reorder') }}", {
                    positions: positions,
                    _token: '{{ csrf_token() }}'
                });
            }
        });

        $('.delete-image').on('click', function () {
            let id = $(this).data('id');
            if (confirm('Наистина ли искате да изтриете тази снимка?')) {
                $.ajax({
                    url: "{{ url('admin/properties/images') }}/" + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endpush
