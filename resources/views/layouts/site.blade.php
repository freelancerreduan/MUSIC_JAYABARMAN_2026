@php $siteName = setting('site_name', 'Jaya Barman'); @endphp
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', $siteName)</title>
  <meta name="description" content="{{ $page->meta_description ?? setting('meta_description') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Tiro+Bangla&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-expand-lg fixed-top site-nav" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand brand-name d-lg-none" href="{{ route('home') }}">{{ $siteName }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="mainNav">
        <ul class="navbar-nav align-items-lg-center">
          @foreach ($navPages as $navPage)
            @php $active = request()->routeIs($navPage->routeName()); @endphp
            <li class="nav-item"><a class="nav-link {{ $active ? 'active' : '' }}" @if ($active) aria-current="page" @endif href="{{ $navPage->url() }}">{{ $navPage->nav_label }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer class="site-footer">
    <div class="container">
      <p class="font-display fs-4 text-white mb-3">{{ $siteName }}</p>
      @include('site.partials.social')
      <nav class="footer-links my-4">
        @foreach ($navPages as $navPage)
          <a href="{{ $navPage->url() }}">{{ $navPage->nav_label }}</a>
        @endforeach
      </nav>
      <p class="copyright mb-1">&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
      @if (setting('footer_credit_text'))
        <p class="copyright mb-0">Developed by <a href="{{ setting('footer_credit_url', '#') }}" class="dev-credit" target="_blank" rel="noopener">{{ setting('footer_credit_text') }}</a></p>
      @endif
    </div>
  </footer>

  <button class="back-top" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>

  @stack('modals')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}?v={{ filemtime(public_path('assets/js/main.js')) }}"></script>
</body>
</html>
