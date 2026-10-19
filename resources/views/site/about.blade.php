@extends('layouts.site')

@section('title', 'About | '.setting('site_name'))

@section('content')
  @include('site.partials.hero')

  <section class="section-sm pt-3">
    <div class="container">
      <div class="row g-4 g-lg-5 align-items-start">
        <div class="col-lg-5 reveal">
          <div class="portrait-wrap mx-auto" style="max-width:460px">
            <div class="portrait-frame rounded-4"><img class="rounded-4" src="{{ media_url(setting('portrait')) }}" alt="Portrait of {{ setting('site_name') }}"></div>
          </div>
        </div>
        <div class="col-lg-7 reveal">
          <h2 class="section-title mb-3">Personal Details</h2>
          <ul class="info-list mb-5">
            <li><i class="bi bi-person"></i><span>Name: <strong>{{ Str::upper(setting('site_name')) }}</strong></span></li>
            <li><i class="bi bi-stars"></i><span>Actor, Musician and Visual Artist</span></li>
            @if (setting('phone'))<li><i class="bi bi-whatsapp"></i><span>Cell and WhatsApp: <a href="tel:{{ setting('phone') }}"><strong>{{ setting('phone') }}</strong></a></span></li>@endif
            @if (setting('email'))<li><i class="bi bi-envelope"></i><span>E-Mail: <a href="mailto:{{ setting('email') }}"><strong>{{ setting('email') }}</strong></a></span></li>@endif
          </ul>
          @if ($affiliations->isNotEmpty())
            <h2 class="section-title mb-3">Current Status</h2>
            <div class="row g-3">
              @foreach ($affiliations as $aff)
                <div class="col-sm-6">
                  <div class="status-card">
                    <h4>{{ $aff->role }}</h4>
                    <p>{!! nl2br(e($aff->organization)) !!}</p>
                    @if ($aff->url)<a href="{{ $aff->url }}" target="_blank" rel="noopener" class="small">{{ preg_replace('#^https?://#', '', $aff->url) }}</a>@endif
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <section class="section-sm">
    <div class="container">
      {{-- Two columns that balance themselves: a long box takes more room, a short one less --}}
      <div class="cv-masonry">
        @foreach ($sections as $section)
          <div class="cv-block reveal">
            <h2>@if ($section->icon)<i class="bi bi-{{ $section->icon }}"></i>@endif{{ $section->title }}</h2>
            @foreach ($section->blocks as $block)
              @if ($block->heading)<h3>{{ $block->heading }}</h3>@endif
              @switch($block->type)
                @case('chips')
                  <ul class="chip-list">@foreach ($block->lines() as $line)<li>{{ $line }}</li>@endforeach</ul>
                  @break
                @case('text')
                  @foreach ($block->lines() as $line)<p @class(['mb-0' => $loop->parent->last && $loop->last])>{{ $line }}</p>@endforeach
                  @break
                @case('links')
                  <div class="link-pills">
                    @foreach ($block->pairs() as [$label, $url])
                      <a href="{{ $url }}" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right"></i>{{ $label ?? preg_replace('#^https?://#', '', $url) }}</a>
                    @endforeach
                  </div>
                  @break
                @default
                  <ul class="timeline">
                    @foreach ($block->pairs() as [$year, $text])
                      <li>@if ($year)<span class="year">{{ $year }}</span>@endif{{ $text }}</li>
                    @endforeach
                  </ul>
              @endswitch
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
