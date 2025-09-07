@extends('frontend.EstateAgency.layouts.app')

@section('title', 'Начало - Домо Лукс')

@section('content')

    {{-- Hero Section --}}
    @include('frontend.EstateAgency.sections.hero')

    {{-- Services Section --}}
    @include('frontend.EstateAgency.sections.services')

    {{-- Agents Section --}}
    @include('frontend.EstateAgency.sections.agents')

    {{-- Testimonials Section --}}
    @include('frontend.EstateAgency.sections.testimonials')

@endsection
