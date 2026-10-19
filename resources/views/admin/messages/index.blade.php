@extends('layouts.admin')

@section('title', 'Messages')
@section('subtitle', 'Contact form inbox')

@section('content')
  <div class="page-head">
    <div><h2>Messages</h2><p>Enquiries sent from the Contacts page.</p></div>
    <div class="actions">
      <div class="tabs">
        <a href="{{ route('admin.messages.index') }}" @class(['active' => ! request('filter')])>All ({{ $counts['all'] }})</a>
        <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" @class(['active' => request('filter') === 'unread'])>Unread ({{ $counts['unread'] }})</a>
        <a href="{{ route('admin.messages.index', ['filter' => 'read']) }}" @class(['active' => request('filter') === 'read'])>Read</a>
      </div>
      <form class="search" style="width:240px" action="{{ route('admin.messages.index') }}">
        <i class="bi bi-search"></i>
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search messages">
        @if (request('filter'))<input type="hidden" name="filter" value="{{ request('filter') }}">@endif
      </form>
    </div>
  </div>

  <div class="card">
    @if ($messages->isEmpty())
      <div class="empty"><i class="bi bi-inbox"></i>No messages found.</div>
    @else
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th>Date</th><th>From</th><th>Subject</th><th>Message</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            @foreach ($messages as $m)
              <tr @class(['unread' => ! $m->read_at])>
                <td>{{ $m->created_at->format('Y-m-d') }}<small>{{ $m->created_at->format('h:i A') }}</small></td>
                <td><strong>{{ $m->name }}</strong><small>{{ $m->email }}</small></td>
                <td><span class="badge tone-blue">{{ $m->subject }}</span></td>
                <td style="max-width:340px"><a href="{{ route('admin.messages.show', $m) }}" class="truncate" style="display:block;color:inherit">{{ $m->body }}</a></td>
                <td>@if ($m->read_at)<span class="badge dot tone-green">Read</span>@else<span class="badge dot tone-pink">New</span>@endif</td>
                <td class="num"><div class="row-actions">
                  <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-sm"><i class="bi bi-eye"></i>View</a>
                  @include('admin.partials.delete', ['action' => route('admin.messages.destroy', $m), 'confirm' => 'Delete this message?'])
                </div></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{ $messages->links() }}
    @endif
  </div>
@endsection
