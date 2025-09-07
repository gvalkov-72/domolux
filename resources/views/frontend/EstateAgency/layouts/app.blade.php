<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title', 'Домо Лукс')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('frontend/estateagency/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('frontend/estateagency/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/estateagency/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/estateagency/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/estateagency/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/estateagency/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/estateagency/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('frontend/estateagency/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="@yield('body-class')">

  <!-- Header -->
  @include('frontend.EstateAgency.partials.header')

  <!-- Main Content -->
  <main class="main">
    @yield('content')
  </main>

  <!-- Footer -->
  @include('frontend.EstateAgency.partials.footer')

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/estateagency/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/estateagency/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('frontend/estateagency/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('frontend/estateagency/assets/js/main.js') }}"></script>

  <script>
    AOS.init();
  </script>
</body>
</html>
