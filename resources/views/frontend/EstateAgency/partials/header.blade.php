<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('frontend.home') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('frontend/EstateAgency/assets/img/logo_broker_w_bg.jpg') }}" 
                 alt="Домо Лукс" 
                 class="img-fluid me-2" 
                 style="max-height: 70px;">
            <h6 class="sitename m-0">Луксат е там където е дома</h6>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                {{-- Начало --}}
                <li>
                    <a href="{{ route('frontend.home') }}" class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                        {{ __('Начало') }}
                    </a>
                </li>

                {{-- Динамични страници от базата --}}
                @php
                    use App\Models\Page;
                    $pages = Page::where('is_active', 1)->get();
                @endphp

                @foreach($pages as $page)
                    <li>
                        <a href="{{ route('frontend.page.show', $page->slug) }}"
                           class="{{ request()->is($page->slug) ? 'active' : '' }}">
                            {{ $page->translate()->title }}
                        </a>
                    </li>
                @endforeach

                {{-- Контакт (ако е отделна страница) --}}
                <li>
                    <a href="{{ route('frontend.page.show', 'contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">
                        {{ __('Контакт') }}
                    </a>
                </li>

                {{-- Language Switcher --}}
                @php
                    $languages = \App\Models\Language::active()->orderBy('position')->get();
                    $currentLocale = app()->getLocale();
                @endphp
                @if($languages->count() > 1)
                    <li class="dropdown">
                        <a href="#">
                            🌐 {{ strtoupper($currentLocale) }} <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            @foreach($languages as $lang)
                                <li>
                                    <a href="{{ route('frontend.language.switch', $lang->code) }}">
                                        @if($lang->code === $currentLocale)
                                            ✓ <strong>{{ $lang->name }}</strong>
                                        @else
                                            {{ $lang->name }}
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
