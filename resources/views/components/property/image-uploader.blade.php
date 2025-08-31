@props(['propertyId'])

<div class="form-group">
    <label for="dropzone">{{ __('properties.upload_images') }}</label>

    <form action="{{ route('admin.properties.images.store', $propertyId) }}"
          class="dropzone"
          id="property-dropzone"
          enctype="multipart/form-data">
        @csrf
    </form>
</div>

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.propertyDropzone = {
            paramName: 'image',
            maxFilesize: 5, // MB
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            dictDefaultMessage: "{{ __('properties.drag_drop_or_click') }}",
            init: function () {
                this.on("success", function (file, response) {
                    file.id = response.id;
                });

                this.on("removedfile", function (file) {
                    if (file.id) {
                        fetch("{{ url('admin/properties/images') }}/" + file.id, {
                            method: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            }
                        });
                    }
                });
            }
        };
    </script>
@endpush
