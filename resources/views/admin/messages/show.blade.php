@extends('layouts.admin')

@section('title', 'Message')
@section('subtitle', 'Contact form inbox')

@section('content')
  <div class="page-head">
    <div><h2>{{ $message->subject }}</h2><p>From {{ $message->name }} · {{ $message->created_at->format('d M Y, h:i A') }}</p></div>
    <div class="actions">
      <a href="{{ route('admin.messages.index') }}" class="btn"><i class="bi bi-arrow-left"></i>Inbox</a>
      <form method="POST" action="{{ route('admin.messages.toggle', $message) }}">
        @csrf @method('PATCH')
        <button class="btn" type="submit"><i class="bi bi-envelope{{ $message->read_at ? '' : '-open' }}"></i>Mark as {{ $message->read_at ? 'unread' : 'read' }}</button>
      </form>
      <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.$message->subject) }}" class="btn btn-primary"><i class="bi bi-reply"></i>Reply by email</a>
    </div>
  </div>

  <div class="grid g-form">
    <div class="card">
      <div class="card-head"><h3>Message</h3></div>
      <div class="card-body msg-body">{{ $message->body }}</div>
    </div>
    <div class="card">
      <div class="card-head"><h3>Sender</h3></div>
      <div class="card-body">
        <ul class="meta-list">
          <li><i class="bi bi-person"></i><span><small>Name</small>{{ $message->name }}</span></li>
          <li><i class="bi bi-envelope"></i><span><small>Email</small><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></span></li>
          <li><i class="bi bi-tag"></i><span><small>Subject</small>{{ $message->subject }}</span></li>
          <li><i class="bi bi-clock"></i><span><small>Received</small>{{ $message->created_at->format('d M Y, h:i A') }} ({{ $message->created_at->diffForHumans() }})</span></li>
        </ul>
      </div>
      <div class="card-foot">
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="Delete this message?">
          @csrf @method('DELETE')
          <button class="btn btn-danger" type="submit"><i class="bi bi-trash3"></i>Delete</button>
        </form>
      </div>
    </div>
  </div>
@endsection
