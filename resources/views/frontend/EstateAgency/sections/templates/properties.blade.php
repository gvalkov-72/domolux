<!-- Real Estate Section -->
<section id="real-estate" class="real-estate section">
  <div class="container">
    <div class="row gy-4">

      @foreach($section->items as $item)
        @php
          $property = $item->property ?? null;
        @endphp

        @if($property)
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="card">
              <img src="{{ $property->mainImageUrl() }}" 
                   alt="{{ $property->getTranslation('title', app()->getLocale()) }}" 
                   class="img-fluid">
              <div class="card-body">
                <span class="sale-rent">
                  {{ $property->status === 'sale' ? __('properties.for_sale') : __('properties.for_rent') }} |
                  {{ number_format($property->price_bgn, 0, '.', ' ') }} лв. /
                  €{{ number_format($property->price_eur, 0, '.', ' ') }}
                </span>
                <h3>
                  <a href="{{ route('properties.show', $property->id) }}" class="stretched-link">
                    {{ $property->getTranslation('title', app()->getLocale()) }}
                  </a>
                </h3>
                <p class="text-muted">
                  {{ $property->propertyType?->getTranslation('title', app()->getLocale()) }} • 
                  {{ $property->getTranslation('address', app()->getLocale()) }}
                </p>
              </div>
            </div>
          </div>
        @else
          {{-- fallback, ако няма property_id --}}
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="card">
              @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" 
                     alt="{{ $item->getTranslation('title', app()->getLocale()) }}" 
                     class="img-fluid">
              @endif
              <div class="card-body">
                <h3>
                  @if($item->url)
                    <a href="{{ $item->url }}" class="stretched-link">
                      {{ $item->getTranslation('title', app()->getLocale()) }}
                    </a>
                  @else
                    {{ $item->getTranslation('title', app()->getLocale()) }}
                  @endif
                </h3>
                <p class="text-muted">
                  {{ $item->getTranslation('subtitle', app()->getLocale()) }}
                </p>
              </div>
            </div>
          </div>
        @endif
      @endforeach

    </div>
  </div>
</section>
<!-- /Real Estate Section -->
