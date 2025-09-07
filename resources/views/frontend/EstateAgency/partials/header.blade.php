<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('frontend.home') }}" class="logo d-flex align-items-center">
            <h1 class="sitename">Домо <span>Лукс</span></h1>
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
            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
