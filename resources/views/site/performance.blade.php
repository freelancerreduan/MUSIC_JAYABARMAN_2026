@extends('layouts.site')

@section('title', $page->title.' | '.setting('site_name'))

@section('content')
  @include('site.partials.hero')

  @foreach ($concerts as $concert)
    <section class="section-sm {{ $loop->first ? 'pt-2' : 'pt-0' }}">
      <div class="container">
        <div class="concert-box reveal" id="concert-{{ $concert->id }}">
          <div class="row g-4 g-lg-5">
            <div class="col-lg-4">
              @if ($concert->eyebrow)<span class="eyebrow">{{ $concert->eyebrow }}</span>@endif
              <h2>{{ $concert->title }}</h2>
              <ul class="concert-meta">
                @if ($concert->event_date)<li><i class="bi bi-calendar-event"></i>{{ $concert->event_date->format('j F Y') }}</li>@endif
                @if ($concert->location)<li><i class="bi bi-geo-alt"></i>{{ $concert->location }}</li>@endif
                @if ($concert->genres)<li><i class="bi bi-music-note-list"></i>{{ $concert->genres }}</li>@endif
              </ul>
              @if ($concert->image)
                <figure class="concert-photo">
                  <img src="{{ media_url($concert->image) }}" alt="{{ $concert->title }}" loading="lazy">
                </figure>
              @endif
            </div>
            <div class="col-lg-8">
              {!! paragraphs($concert->body, '') !!}
            </div>
          </div>
        </div>
      </div>
    </section>
  @endforeach

  <section class="section-sm pt-0">
    <div class="container">
      @foreach ($videos as $video)
        <div class="row g-4 g-lg-5 align-items-center perf-item" id="video-{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}">
          <div class="col-lg-7 {{ $loop->even ? 'order-lg-2' : '' }} reveal">
            @include('site.partials.video-box')
          </div>
          <div class="col-lg-5 reveal">
            <span class="perf-num">Video {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
            <h2>{{ $video->title }}</h2>
            @if ($video->title_bn)<p class="perf-bn">{{ $video->title_bn }}</p>@endif
            <div class="perf-body">{!! paragraphs($video->body) !!}</div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endsection
