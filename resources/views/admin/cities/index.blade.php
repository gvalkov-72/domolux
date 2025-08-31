@extends('adminlte::page')

@section('title', __('cities.title'))

@section('content_header')
    <h1>{{ __('cities.title') }}</h1>
@stop

@section('content')
    <a href="{{ route('admin.cities.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> {{ __('cities.create') }}
    </a>

    @if ($cities->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('cities.name') }}</th>
                        <th>{{ __('cities.country') }}</th>
                        <th>{{ __('cities.active') }}</th>
                        <th>{{ __('cities.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <td>{{ $city->id }}</td>
                            <td>{{ $city->getTranslation('name', app()->getLocale()) }}</td>
                            <td>{{ $city->country?->getTranslation('name', app()->getLocale()) ?? $city->country?->code }}</td>
                            <td>
                                @if ($city->is_active)
                                    <span class="badge badge-success">{{ __('cities.active_yes') }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ __('cities.active_no') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('cities.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $cities->links() }}
    @else
        <p>{{ __('cities.no_records') }}</p>
    @endif
@stop
