@extends('layouts.admin')

@section('title', 'Current status')
@section('subtitle', 'About page')

@section('content')
  <div class="page-head">
    <div><h2>Current status</h2><p>Role cards under “Current Status” on the About page.</p></div>
    <div class="actions"><a href="{{ route('admin.affiliations.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add card</a></div>
  </div>

  <div class="card">
    @if ($affiliations->isEmpty())
      <div class="empty"><i class="bi bi-person-badge"></i>No cards yet.</div>
    @else
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th>Role</th><th>Organisation</th><th>Website</th><th class="num">Action</th></tr></thead>
          <tbody>
            @foreach ($affiliations as $a)
              <tr>
                <td><strong>{{ $a->role }}</strong></td>
                <td>{!! nl2br(e($a->organization)) !!}</td>
                <td>@if ($a->url)<a href="{{ $a->url }}" target="_blank" rel="noopener">{{ preg_replace('#^https?://#', '', $a->url) }}</a>@else — @endif</td>
                <td class="num"><div class="row-actions">
                  <a href="{{ route('admin.affiliations.edit', $a) }}" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  @include('admin.partials.delete', ['action' => route('admin.affiliations.destroy', $a)])
                </div></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
