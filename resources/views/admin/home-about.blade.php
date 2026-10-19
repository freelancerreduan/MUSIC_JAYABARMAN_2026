@extends('layouts.admin')

@php $about = request('section') === 'about'; @endphp
@section('title', $about ? 'About · Photo' : 'Home · About the artist')

@section('content')
  <form method="POST" enctype="multipart/form-data" action="{{ route('admin.home-about', ['section' => request('section')]) }}">
    @csrf @method('PUT')

    <div class="page-head">
      <div>
        <h2>{{ $about ? 'Photo (About page)' : 'About the artist (Home page)' }}</h2>
        <p>{{ $about ? 'The photo next to Personal Details. The same photo is used on the Home page.' : 'The text and photo below the big banner on the Home page. The photo is also used on the About page.' }}</p>
      </div>
      <div class="actions"><button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button></div>
    </div>

    <div class="grid {{ $about ? '' : 'g-form' }}" @if ($about) style="max-width:480px" @endif>
      @unless ($about)
        <div class="card">
          <div class="card-head"><h3>Description</h3></div>
          <div class="card-body form-grid">
            <x-admin.textarea name="home_intro" label="Text about the artist" :value="plain_paragraphs(setting('home_intro'))" rows="16"
              hint="Leave one empty line between paragraphs. **word** = bold." />
          </div>
        </div>
      @endunless
      <div class="card">
        <div class="card-head"><h3>Photo</h3></div>
        <div class="card-body" style="display:grid;gap:14px">
          @if (setting('portrait'))<img src="{{ media_url(setting('portrait')) }}" alt="" style="border-radius:12px;width:100%;aspect-ratio:4/5;object-fit:cover">@endif
          <x-admin.media name="portrait" :value="setting('portrait')" hint="A tall (portrait) photo works best." />
        </div>
      </div>
    </div>
  </form>
@endsection
