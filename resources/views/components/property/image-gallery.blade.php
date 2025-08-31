<div class="row">
    @foreach($images as $image)
        <div class="col-md-2 mb-3 image-wrapper" data-id="{{ $image->id }}">
            <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail">
            <button type="button" class="btn btn-danger btn-sm btn-block mt-1 delete-image" data-id="{{ $image->id }}">
                {{ __('properties.delete') }}
            </button>
        </div>
    @endforeach
</div>
