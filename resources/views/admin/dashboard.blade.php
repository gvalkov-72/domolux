@extends('adminlte::page')

@section('title', __('languages.admin_panel_title'))

@section('content_header')
    <h1>{{ __('languages.admin_panel_header') }}</h1>
@endsection

@section('content')
    <p>{{ __('languages.welcome_message') }}</p>
@endsection
