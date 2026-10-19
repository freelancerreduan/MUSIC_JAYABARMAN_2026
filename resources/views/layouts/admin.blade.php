@php
    $user = auth()->user();
    $menu = \App\Support\AdminMenu::build($user, $unreadCount);
    $crumb = \App\Support\AdminMenu::crumb($menu);
@endphp
<!doctype html>
<html lang="en" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') · {{ setting('site_name', 'Jaya Barman') }} Admin</title>
  <script>try { if (localStorage.getItem("admin-theme") === "dark") document.documentElement.dataset.theme = "dark"; } catch (e) {}</script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Bebas+Neue&family=Tiro+Bangla&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('admin-assets/admin.css') }}?v={{ filemtime(public_path('admin-assets/admin.css')) }}" rel="stylesheet">
  @stack('head')
</head>
<body>
<div class="app">
  <aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="brand">
      <div class="brand-mark">{{ Str::upper(setting('site_name', 'Jaya Barman')) }}</div>
      <div class="brand-sub">Studio admin</div>
    </a>

    <nav class="side-nav">
      <div class="side-label">Main</div>
      @foreach ($menu['main'] as $item)
        <a href="{{ $item[2] }}" class="side-link {{ $item[3] ? 'active' : '' }}" @if ($item[5] ?? false) target="_blank" @endif>
          <i class="bi bi-{{ $item[1] }}"></i>{{ $item[0] }}
          @if ($item[4] ?? 0)<span class="count">{{ $item[4] }}</span>@elseif ($item[5] ?? false)<i class="bi bi-box-arrow-up-right chev"></i>@endif
        </a>
      @endforeach

      <div class="side-label">Website sections <span class="side-hint">same as the site menu</span></div>
      @foreach ($menu['website'] as $section)
        <div class="side-group {{ $section['open'] ? 'open' : '' }}">
          <button type="button" class="side-link {{ $section['open'] ? 'active' : '' }}">
            <i class="bi bi-{{ $section['icon'] }}"></i>{{ $section['label'] }}
            @if ($section['badge'])<span class="count" style="margin-left:auto;margin-right:6px">{{ $section['badge'] }}</span>@endif
            <i class="bi bi-chevron-right chev" @if ($section['badge']) style="margin-left:0" @endif></i>
          </button>
          <div class="side-sub">
            @foreach ($section['children'] as $child)
              <a href="{{ $child[1] }}" class="{{ $child[2] ? 'active' : '' }}" title="{{ $child[4] }}"><span class="side-no">{{ $loop->iteration }}</span>{{ $child[0] }}@if ($child[3] ?? 0) <span class="count sm">{{ $child[3] }}</span>@endif</a>
            @endforeach
            <a href="{{ $section['url'] }}" target="_blank" class="side-view"><i class="bi bi-box-arrow-up-right"></i> View {{ $section['label'] }} page</a>
          </div>
        </div>
      @endforeach

    </nav>

    <div class="side-user">
      <span class="avatar">{{ $user->initials() }}</span>
      <div class="truncate">
        <strong class="truncate">{{ $user->name }}</strong>
        <small>Admin</small>
      </div>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" title="Log out" aria-label="Log out"><i class="bi bi-box-arrow-right"></i></button>
      </form>
    </div>
  </aside>
  <div class="scrim" data-sidebar-toggle></div>

  <div class="main">
    <header class="topbar">
      <button class="icon-btn menu-btn" type="button" data-sidebar-toggle aria-label="Menu"><i class="bi bi-list"></i></button>
      <div class="topbar-title">
        <h1>@yield('title', 'Dashboard')</h1>
        <p>@if ($crumb){{ $crumb['section'] }} page · {{ $crumb['item'] }}@else @yield('subtitle', 'Website overview') @endif</p>
      </div>

      <div class="topbar-actions">
        <button class="icon-btn" type="button" data-theme-toggle aria-label="Toggle dark mode"><i class="bi bi-moon theme-dark"></i><i class="bi bi-sun theme-light"></i></button>

        <div class="dropdown">
          <button class="icon-btn" type="button" data-dropdown aria-label="Notifications">
            <i class="bi bi-bell"></i>
            @if ($unreadCount)<span class="dot">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>@endif
          </button>
          <div class="dropdown-menu notif-menu">
            <div class="dropdown-head">New messages</div>
            @forelse ($unreadMessages as $m)
              <a href="{{ route('admin.messages.show', $m) }}" class="notif-item">
                <span class="avatar sm">{{ mb_strtoupper(mb_substr($m->name, 0, 1)) }}</span>
                <span class="truncate"><strong>{{ $m->name }}</strong><p class="truncate">{{ $m->subject }} — {{ Str::limit($m->body, 50) }}</p><small>{{ $m->created_at->diffForHumans() }}</small></span>
              </a>
            @empty
              <div class="empty" style="padding:18px"><i class="bi bi-inbox"></i>No new messages</div>
            @endforelse
            <div class="sep"></div>
            <a href="{{ route('admin.messages.index') }}"><i class="bi bi-envelope"></i>Open inbox</a>
          </div>
        </div>

        <div class="dropdown">
          <button class="user-chip" type="button" data-dropdown>
            <span class="avatar">{{ $user->initials() }}</span>
            <span class="who"><strong>{{ $user->name }}</strong><small>Admin</small></span>
            <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <a href="{{ route('admin.profile') }}"><i class="bi bi-key"></i>Login &amp; password</a>
            <a href="{{ route('home') }}" target="_blank"><i class="bi bi-globe2"></i>View website</a>
            <div class="sep"></div>
            <form method="POST" action="{{ route('admin.logout') }}">
              @csrf
              <button type="submit"><i class="bi bi-box-arrow-right"></i>Log out</button>
            </form>
          </div>
        </div>
      </div>
    </header>

    <main class="content">
      @if ($crumb)
        <div class="crumb">
          <span><i class="bi bi-{{ $crumb['icon'] }}"></i> Website <i class="bi bi-chevron-right"></i> <strong>{{ $crumb['section'] }}</strong> <i class="bi bi-chevron-right"></i> {{ $crumb['item'] }}<small class="crumb-hint"><i class="bi bi-geo-alt"></i>{{ $crumb['hint'] }}</small></span>
          <a href="{{ $crumb['url'] }}" target="_blank" class="btn btn-sm"><i class="bi bi-box-arrow-up-right"></i>View {{ $crumb['section'] }} page</a>
        </div>
      @endif
      @if (session('success'))
        <div class="flash" data-autohide><i class="bi bi-check-circle-fill"></i>{{ session('success') }}</div>
      @endif
      @if ($errors->any())
        <div class="flash error"><i class="bi bi-exclamation-triangle-fill"></i>Please check the highlighted fields.</div>
      @endif
      @yield('content')
    </main>

    <footer class="app-footer">&copy; {{ date('Y') }} {{ setting('site_name', 'Jaya Barman') }}. All rights reserved.</footer>
  </div>
</div>

<script src="{{ asset('admin-assets/admin.js') }}?v={{ filemtime(public_path('admin-assets/admin.js')) }}"></script>
@stack('scripts')
</body>
</html>
