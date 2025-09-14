{{-- resources/views/frontend/EstateAgency/sections/templates/hero.blade.php --}}
<section id="hero" class="hero section dark-background">
  <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    @foreach($section->items as $item)
      <div class="carousel-item @if($loop->first) active @endif">
        @php
            $img = $item->image ? asset('storage/' . $item->image) : asset('frontend/estateagency/assets/img/hero-carousel/hero-carousel-1.jpg');
        @endphp
        <img src="{{ $img }}" alt="">
        <div class="carousel-container">
          <div>
            <p>{{ $item->getTranslation('subtitle', app()->getLocale()) }}</p>
            <h2>{!! $item->getTranslation('title', app()->getLocale()) !!}</h2>
            @if($item->url)
              <a href="{{ $item->url }}" class="btn-get-started">
                  {{ $item->getTranslation('button_text', app()->getLocale()) ?: __('Прочети още') }}
              </a>
            @endif
          </div>
        </div>
      </div>
    @endforeach

    <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>

    <ol class="carousel-indicators"></ol>
  </div>
</section>
