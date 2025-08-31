@extends('adminlte::page')

@section('title', __('property_images.title'))

@section('content_header')
    <h1>{{ __('property_images.title') }}</h1>
    <a href="{{ route('admin.property_images.create') }}" class="btn btn-primary mb-2">{{ __('property_images.add_image') }}</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('property_images.property') }}</th>
                        <th>{{ __('property_images.description') }}</th>
                        <th>{{ __('property_images.image') }}</th>
                        <th>{{ __('property_images.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($images as $image)
                        <tr>
                            <td>{{ $image->id }}</td>
                            <td>{{ $image->property->name ?? '' }}</td>
                            <td>
                                <ul class="nav nav-tabs" id="desc-tabs-{{ $image->id }}" role="tablist">
                                    @foreach($activeLanguages as $key => $lang)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $key === 0 ? 'active' : '' }}" 
                                               id="tab-{{ $lang }}-{{ $image->id }}"
                                               data-toggle="tab"
                                               href="#desc-{{ $lang }}-{{ $image->id }}"
                                               role="tab">
                                                {{ strtoupper($lang) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content border p-2" id="desc-tabs-content-{{ $image->id }}">
                                    @foreach($activeLanguages as $key => $lang)
                                        <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}"
                                             id="desc-{{ $lang }}-{{ $image->id }}"
                                             role="tabpanel">
                                            {{ $image->getTranslation('description', $lang) }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                @if($image->image_path)
                                    <img src="{{ asset('storage/'.$image->image_path) }}" alt="" width="100">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.property_images.edit', $image) }}" class="btn btn-sm btn-warning">{{ __('property_images.edit') }}</a>
                                <form action="{{ route('admin.property_images.destroy', $image) }}" method="POST" class="d-inline-block" onsubmit="return confirm('{{ __('property_images.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">{{ __('property_images.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $images->links() }}
        </div>
    </div>
@stop
