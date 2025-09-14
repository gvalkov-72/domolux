{{-- resources/views/admin/properties/index.blade.php --}}
@extends('adminlte::page')

@section('title', __('Имотите'))

@section('content_header')
    <h1>{{ __('Имотите') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ __('Списък с имоти') }}</h3>
            <a href="{{ route('admin.properties.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> {{ __('Добави нов имот') }}
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Код') }}</th>
                        <th>{{ __('Заглавие') }}</th>
                        <th>{{ __('Тип имот') }}</th>
                        <th>{{ __('Държава') }}</th>
                        <th>{{ __('Град') }}</th>
                        <th>{{ __('Цена (лв.)') }}</th>
                        <th>{{ __('Активен') }}</th>
                        <th>{{ __('Действия') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                        <tr>
                            <td>{{ $property->code }}</td>
                            <td>{{ $property->translate(app()->getLocale())->title ?? '' }}</td>
                            <td>{{ $property->propertyType?->translate(app()->getLocale())->name ?? '' }}</td>
                            <td>{{ $property->country?->translate(app()->getLocale())->name ?? '' }}</td>
                            <td>{{ $property->city?->translate(app()->getLocale())->name ?? '' }}</td>
                            <td>{{ number_format($property->price_bgn, 2) }}</td>
                            <td>
                                @if($property->is_active)
                                    <span class="badge badge-success">{{ __('Да') }}</span>
                                @else
                                    <span class="badge badge-danger">{{ __('Не') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Сигурни ли сте?') }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.properties.show', $property) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-images"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">{{ __('Няма добавени имоти') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
