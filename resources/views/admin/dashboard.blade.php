@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Manage your website')

@section('content')
  <div class="page-head">
    <div>
      <h2>{{ $greeting }}, {{ auth()->user()->firstName() }}</h2>
      <p>Each box is one page of your website. Its parts are listed top to bottom, the same order you see on the site.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="btn"><i class="bi bi-globe2"></i>View website</a>
  </div>

  <ol class="how-to">
    <li><span>1</span><div><strong>Find the page</strong><small>Same name as the website menu</small></div></li>
    <li><span>2</span><div><strong>Click the part to change</strong><small>Listed top to bottom, like on the page</small></div></li>
    <li><span>3</span><div><strong>Edit &amp; save</strong><small>Then click <i class="bi bi-box-arrow-up-right"></i> to see it live</small></div></li>
  </ol>

  @if ($unread)
    <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="card mini tone-pink" style="margin-bottom:20px">
      <span class="mini-icon"><i class="bi bi-envelope-exclamation"></i></span>
      <span><strong>{{ $unread }} new {{ Str::plural('message', $unread) }}</strong><span>Sent from the Contacts page. Click to read.</span></span>
    </a>
  @endif

  <div class="grid g-3 section-cards">
    @foreach ($sections as $section)
      <div class="card section-card">
        <div class="section-card-head">
          <span class="list-icon tone-blue"><i class="bi bi-{{ $section['icon'] }}"></i></span>
          <h3>{{ $section['label'] }} <small>page</small></h3>
          <a href="{{ $section['url'] }}" target="_blank" class="btn btn-sm" title="Open the {{ $section['label'] }} page on the website"><i class="bi bi-box-arrow-up-right"></i>View</a>
        </div>
        <div class="page-outline-label"><i class="bi bi-arrow-down"></i> Under the top banner</div>
        <ol class="page-outline">
          @foreach ($section['children'] as $child)
            <li>
              <a href="{{ $child[1] }}">
                <span class="no">{{ $loop->iteration }}</span>
                <span class="what"><strong>{{ $child[0] }}@if ($child[3] ?? 0) <span class="badge tone-pink">{{ $child[3] }} new</span>@endif</strong><small>{{ $child[4] }}</small></span>
                <span class="edit"><i class="bi bi-pencil"></i>Edit</span>
              </a>
            </li>
          @endforeach
        </ol>
      </div>
    @endforeach
  </div>

  <div class="card mt">
    <div class="card-head">
      <div><h3>Latest messages</h3><p>From the contact form on the Contacts page</p></div>
      <a href="{{ route('admin.messages.index') }}" class="btn btn-sm">All messages</a>
    </div>
    @if ($messages->isEmpty())
      <div class="empty"><i class="bi bi-inbox"></i>No messages yet.</div>
    @else
      <ul class="list">
        @foreach ($messages as $m)
          <li>
            <span class="avatar">{{ mb_strtoupper(mb_substr($m->name, 0, 1)) }}</span>
            <a href="{{ route('admin.messages.show', $m) }}" class="grow" style="color:inherit;min-width:0">
              <strong class="truncate">{{ $m->name }} · {{ $m->subject }}</strong>
              <small class="truncate" style="display:block">{{ $m->body }}</small>
            </a>
            <small class="end">{{ $m->created_at->diffForHumans() }}</small>
            @unless ($m->read_at)<span class="badge dot tone-pink">New</span>@endunless
          </li>
        @endforeach
      </ul>
    @endif
  </div>
@endsection
