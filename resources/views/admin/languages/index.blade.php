@extends('adminlte::page')

@section('title', __('languages.languages_title'))

@section('content_header')
    <h1>{{ __('languages.languages_header') }}</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.languages.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> {{ __('languages.add_new_language') }}
    </a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="languages-table">
                <thead>
                    <tr>
                        <th>{{ __('languages.id') }}</th>
                        <th>{{ __('languages.code') }}</th>
                        <th>{{ __('languages.name') }}</th>
                        <th>{{ __('languages.active') }}</th>
                        <th>{{ __('languages.default_admin') }}</th>
                        <th>{{ __('languages.default_site') }}</th>
                        <th>{{ __('languages.description') }}</th>
                        <th>{{ __('languages.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    @foreach ($languages as $language)
                        <tr data-id="{{ $language->id }}">
                            <td>{{ $language->id }}</td>
                            <td>{{ $language->code }}</td>
                            <td>{{ $language->name }}</td>
                            <td>
                                @if ($language->is_active)
                                    <span class="badge bg-success">{{ __('languages.yes') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('languages.no') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($language->is_default_admin)
                                    <span class="badge bg-primary">{{ __('languages.yes') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('languages.no') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($language->is_default_site)
                                    <span class="badge bg-primary">{{ __('languages.yes') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('languages.no') }}</span>
                                @endif
                            </td>
                            <td>{{ $language->description }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <a href="{{ route('admin.languages.edit', $language->id) }}" class="btn btn-sm btn-warning" title="{{ __('languages.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.languages.destroy', $language->id) }}" method="POST"
                                        onsubmit="return confirm('{{ __('languages.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="{{ __('languages.delete') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-sm btn-secondary move-up" data-id="{{ $language->id }}" title="{{ __('languages.move_up') }}">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                    <button class="btn btn-sm btn-secondary move-down" data-id="{{ $language->id }}" title="{{ __('languages.move_down') }}">
                                        <i class="fas fa-arrow-down"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#sortable").sortable({
                handle: "td",
                update: function(event, ui) {
                    var order = $(this).sortable('toArray', {
                        attribute: 'data-id'
                    });
                    $.ajax({
                        url: "{{ route('admin.languages.sort') }}",
                        method: 'POST',
                        data: {
                            order: order,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function() {
                            alert('{{ __('languages.error_save_order') }}');
                        }
                    });
                }
            });
            $("#sortable").disableSelection();

            $('.move-up, .move-down').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var direction = $(this).hasClass('move-up') ? 'up' : 'down';
                var row = $(this).closest('tr');

                if (direction === 'up') {
                    var prevRow = row.prev();
                    if (prevRow.length) {
                        row.insertBefore(prevRow);
                    }
                } else {
                    var nextRow = row.next();
                    if (nextRow.length) {
                        row.insertAfter(nextRow);
                    }
                }

                $.ajax({
                    url: "{{ route('admin.languages.move') }}",
                    method: 'POST',
                    data: {
                        id: id,
                        direction: direction,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function() {
                        alert('{{ __('languages.error_move') }}');
                    }
                });
            });
        });
    </script>
@stop
