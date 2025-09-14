{{-- resources/views/frontend/EstateAgency/sections/templates/real_estate.blade.php --}}
<section id="real-estate" class="real-estate section">
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ $section->getTranslation('title', app()->getLocale()) }}</h2>
        <p>{{ $section->getTranslation('excerpt', app()->getLocale()) }}</p>
    </div>

    <div class="container">
        <div class="row gy-4">
            @foreach($section->items as $item)
                @php
                    $property = $item->property; 
                    $img = $item->image 
                        ? asset('storage/'.$item->image) 
                        : ($property?->mainImage?->url 
                            ? asset('storage/'.$property->mainImage->url) 
                            : asset('frontend/estateagency/assets/img/default-property.jpg'));
                @endphp

                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="property-card">
                        <div class="pic">
                            <img src="{{ $img }}" class="img-fluid" alt="">
                        </div>
                        <div class="property-info">
                            <h4>
                                @if($property)
                                    <a href="{{ route('properties.show', $property->id) }}">
                                        {{ $property->getTranslation('title', app()->getLocale()) }}
                                    </a>
                                @else
                                    {{ $item->getTranslation('title', app()->getLocale()) }}
                                @endif
                            </h4>

                            <p class="text-muted">
                                @if($property)
                                    {{ $property->getTranslation('excerpt', app()->getLocale()) }}
                                @else
                                    {{ $item->getTranslation('excerpt', app()->getLocale()) }}
                                @endif
                            </p>

                            @if($property && $property->price)
                                <div class="price">
                                    {{ number_format($property->price, 0, '.', ' ') }} €
                                </div>
                            @endif

                            @if($item->url)
                                <a href="{{ $item->url }}" class="btn btn-primary mt-2">
                                    {{ __('Виж повече') }}
                                </a>
                            @elseif($property)
                                <a href="{{ route('properties.show', $property->id) }}" class="btn btn-primary mt-2">
                                    {{ __('Виж повече') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
