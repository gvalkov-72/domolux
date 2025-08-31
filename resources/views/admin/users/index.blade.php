@extends('adminlte::page')

@section('title', __('users.users_title'))

@section('content_header')
    <h1>{{ __('users.users_title') }}</h1>
@stop

@section('content')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">{{ __('users.create_user') }}</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('users.name') }}</th>
                    <th>{{ __('users.email') }}</th>
                    <th>{{ __('users.role') }}</th>
                    <th>{{ __('users.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">{{ __('users.view') }}</a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">{{ __('users.edit') }}</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('{{ __('users.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">{{ __('users.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
@stop
