{{-- resources/views/frontend/EstateAgency/index.blade.php --}}
@extends('frontend.EstateAgency.layouts.app')

@section('title', __('Начало') . ' - Домо Лукс')

@section('content')

    @foreach($sections as $section)
        @php $template = $section->type ?? $section->key ?? 'generic'; @endphp

        @if(view()->exists("frontend.EstateAgency.sections.templates.$template"))
            @include("frontend.EstateAgency.sections.templates.$template", ['section' => $section])
        @else
            <section class="section my-5">
                <div class="container">
                    <h2>{{ $section->getTranslation('title', app()->getLocale()) }}</h2>
                    <div>{!! $section->getTranslation('content', app()->getLocale()) !!}</div>
                </div>
            </section>
        @endif
    @endforeach

@endsection
