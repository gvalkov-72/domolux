{{-- resources/views/frontend/EstateAgency/sections/templates/testimonials.blade.php --}}
<section id="testimonials" class="testimonials section">
  <div class="container section-title" data-aos="fade-up">
    <h2>{{ $section->getTranslation('title', app()->getLocale()) }}</h2>
    <p>{{ $section->getTranslation('excerpt', app()->getLocale()) }}</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper init-swiper">
      <div class="swiper-wrapper">
        @foreach($section->items as $item)
          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>{{ $item->getTranslation('content', app()->getLocale()) }}</p>
              <div class="profile mt-auto">
                @php $img = $item->image ? asset('storage/'.$item->image) : asset('frontend/estateagency/assets/img/testimonials/testimonials-1.jpg'); @endphp
                <img src="{{ $img }}" class="testimonial-img" alt="">
                <h3>{{ $item->getTranslation('title', app()->getLocale()) }}</h3>
                <h4>{{ $item->getTranslation('subtitle', app()->getLocale()) }}</h4>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
