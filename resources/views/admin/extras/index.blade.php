@extends('adminlte::page')

@section('title', __('extras.extras'))

@section('content_header')
    <h1>{{ __('extras.extras') }}</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.extras.create') }}" class="btn btn-primary">
            {{ __('extras.create') }}
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('extras.name') }}</th>
                    <th>{{ __('extras.is_active') }}</th>
                    <th>{{ __('extras.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($extras as $extra)
                    <tr>
                        <td>{{ $extra->id }}</td>
                        <td>{{ $extra->getTranslation('name', app()->getLocale(), false) }}</td>
                        <td>
                            @if($extra->is_active)
                                <span class="badge badge-success">{{ __('extras.active') }}</span>
                            @else
                                <span class="badge badge-secondary">{{ __('extras.inactive') }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.extras.edit', $extra) }}" class="btn btn-sm btn-warning">
                                {{ __('extras.edit') }}
                            </a>
                            <form action="{{ route('admin.extras.destroy', $extra) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('extras.confirm_delete') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    {{ __('extras.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{ __('extras.no_extras') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $extras->links() }}
    </div>
@stop
