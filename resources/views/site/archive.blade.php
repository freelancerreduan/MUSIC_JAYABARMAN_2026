@extends('layouts.site')

@section('title', $page->title.' | '.setting('site_name'))

@section('content')
  @include('site.partials.hero')

  <section class="section-sm pt-2">
    <div class="container">
      @if ($items->isEmpty())
        @include('site.partials.empty', ['icon' => 'archive', 'text' => 'Older performances, exhibitions and press will be added here.', 'link' => route('about'), 'label' => 'Full CV'])
      @else
        <div class="row g-4">
          @foreach ($items as $item)
            <div class="col-md-6 col-lg-4 reveal">
              <div class="project-card">
                @if ($item->image)<img src="{{ thumb_url($item->image) }}" alt="{{ $item->title }}" loading="lazy">@endif
                <div class="body">
                  @if ($item->year)<div class="yr">{{ $item->year }}</div>@endif
                  <h3>{{ $item->title }}</h3>
                  @if ($item->description)<p>{{ $item->description }}</p>@endif
                  @if ($item->link)<a href="{{ $item->link }}" target="_blank" rel="noopener" class="small d-inline-block mt-3">Open <i class="bi bi-box-arrow-up-right ms-1"></i></a>@endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>
@endsection
