{{-- resources/views/frontend/EstateAgency/sections/templates/agents.blade.php --}}
<section id="agents" class="agents section">
  <div class="container section-title" data-aos="fade-up">
    <h2>{{ $section->getTranslation('title', app()->getLocale()) }}</h2>
    <p>{{ $section->getTranslation('excerpt', app()->getLocale()) }}</p>
  </div>

  <div class="container">
    <div class="row gy-4">
      @foreach($section->items as $item)
        <div class="col-lg-4 col-md-6" data-aos="fade-up">
          <div class="member">
            @php $img = $item->image ? asset('storage/'.$item->image) : asset('frontend/estateagency/assets/img/team/team-1.jpg'); @endphp
            <div class="pic"><img src="{{ $img }}" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>{{ $item->getTranslation('title', app()->getLocale()) }}</h4>
              <span>{{ $item->getTranslation('subtitle', app()->getLocale()) }}</span>
              <div class="social">
                {{-- опционално: добави социални от преводите/настройките --}}
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
