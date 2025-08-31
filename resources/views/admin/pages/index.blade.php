@extends('adminlte::page')

@section('title', __('pages.title'))

@section('content_header')
    <h1>{{ __('pages.title') }}</h1>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary mb-3">{{ __('pages.create_new') }}</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>{{ __('pages.slug') }}</th>
                <th>{{ __('pages.is_active') }}</th>
                <th>{{ __('pages.sort_order') }}</th>
                <th>{{ __('pages.created_at') }}</th>
                <th>{{ __('pages.updated_at') }}</th>
                <th>{{ __('pages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pages as $page)
                <tr>
                    <td>{{ $page->slug }}</td>
                    <td>
                        @if($page->is_active)
                            <span class="badge badge-success">{{ __('pages.active') }}</span>
                        @else
                            <span class="badge badge-secondary">{{ __('pages.inactive') }}</span>
                        @endif
                    </td>
                    <td>{{ $page->sort_order }}</td>
                    <td>{{ $page->created_at->format('Y-m-d') }}</td>
                    <td>{{ $page->updated_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-warning">{{ __('pages.edit') }}</a>

                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('{{ __('pages.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">{{ __('pages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">{{ __('pages.no_records') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $pages->links() }}
    </div>
@stop
