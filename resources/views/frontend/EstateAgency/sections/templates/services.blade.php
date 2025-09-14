{{-- resources/views/frontend/EstateAgency/sections/templates/services.blade.php --}}
<section id="services" class="services section">
  <div class="container section-title" data-aos="fade-up">
    <h2>{{ $section->getTranslation('title', app()->getLocale()) }}</h2>
    <p>{{ $section->getTranslation('excerpt', app()->getLocale()) }}</p>
  </div>

  <div class="container">
    <div class="row gy-4">
      @foreach($section->items as $item)
        <div class="col-lg-4 col-md-6" data-aos="fade-up">
          <div class="service-item position-relative">
            <div class="icon">
              @if($item->getTranslation('subtitle'))<i class="bi bi-check-circle"></i>@endif
            </div>
            <h3>{{ $item->getTranslation('title', app()->getLocale()) }}</h3>
            <p>{{ $item->getTranslation('excerpt', app()->getLocale()) }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
