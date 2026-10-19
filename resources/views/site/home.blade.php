@extends('layouts.site')

@section('content')
  <header class="hero" @if ($page->hero_image) style="background-image:url('{{ media_url($page->hero_image) }}')" @endif>
    <div class="container">
      <h1 class="hero-title reveal">{{ $page->title }}</h1>
      <div class="d-flex flex-wrap gap-3 justify-content-center reveal">
        <a href="{{ route('performance') }}" class="btn btn-gold"><i class="bi bi-play-fill me-2"></i>Performance</a>
        <a href="{{ route('about') }}" class="btn btn-ghost">About</a>
      </div>
    </div>
    <a href="#about" class="hero-scroll" aria-label="Scroll down"><i class="bi bi-chevron-double-down"></i></a>
  </header>

  <section id="about" class="section">
    <div class="container">
      <div class="row g-4 g-lg-5 align-items-center">
        <div class="col-lg-5 order-lg-2 reveal">
          <div class="portrait-wrap mx-auto" style="max-width:420px">
            <div class="portrait-frame rounded-4"><img class="rounded-4" src="{{ media_url(setting('portrait', 'assets/img/portrait.jpg')) }}" alt="Portrait of {{ setting('site_name') }}"></div>
          </div>
        </div>
        <div class="col-lg-7 order-lg-1 reveal">
          <span class="eyebrow">About the artist</span>
          <h2 class="intro-roles mb-4">Musician<span>|</span>Visual Artist<span>|</span>Actor</h2>
          {!! str_replace('<p', '<p class="lead-text"', paragraphs(setting('home_intro'), '')) !!}
          <a href="{{ route('about') }}" class="btn btn-gold mt-4">Full Profile <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
      </div>
    </div>
  </section>

  @if ($latest)
    <section class="section-sm">
      <div class="container">
        <div class="row g-4 g-lg-5 align-items-center">
          <div class="col-lg-6 reveal">
            <a href="{{ route('performance') }}#concert-{{ $latest->id }}" class="video-card" style="aspect-ratio:16/10">
              <div class="bg" style="background-image:url('{{ media_url($latest->image ?: setting('portrait')) }}');background-position:50% 25%"></div>
              <div class="content">
                <div class="v-by">{{ collect([str($latest->location)->before(',')->value() ?: null, $latest->event_date?->format('j F Y')])->filter()->implode(' · ') }}</div>
                <div class="v-play"><i class="bi bi-play-fill"></i></div>
              </div>
            </a>
          </div>
          <div class="col-lg-6 reveal">
            <span class="eyebrow">Latest</span>
            <h2 class="section-title">{{ $latest->title }}</h2>
            <p class="lead-text">{{ $latest->excerpt }}</p>
            <a href="{{ route('performance') }}" class="btn btn-gold mt-2">Performance <i class="bi bi-arrow-right ms-2"></i></a>
          </div>
        </div>
      </div>
    </section>
  @endif
@endsection
