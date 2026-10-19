@extends('layouts.admin')

@section('title', $section->exists ? 'Edit CV box' : 'Add CV box')

@php
  $blocks = old('blocks', $section->blocks->map(fn ($b) => ['id' => $b->id, 'heading' => $b->heading, 'type' => $b->type, 'content' => $b->content])->all());
  $icon = old('icon', $section->icon ?: 'star');
@endphp

@section('content')
  <form method="POST" action="{{ $section->exists ? route('admin.cv.update', $section) : route('admin.cv.store') }}">
    @csrf
    @if ($section->exists) @method('PUT') @endif

    <div class="page-head">
      <div><h2>{{ $section->exists ? $section->title : 'New CV box' }}</h2><p>One box on the About page, for example “Workshops Given (Major)”.</p></div>
      <div class="actions">
        <a href="{{ route('admin.cv.index') }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button>
      </div>
    </div>

    <div class="grid g-form">
      <div class="stack">
        <div class="card">
          <div class="card-head"><h3><span class="step-no">1</span>Box title &amp; icon</h3></div>
          <div class="card-body form-grid">
            <x-admin.input name="title" label="Box title" :value="$section->title" :full="true" placeholder="e.g. Workshops Given (Major)" required />
            <div class="field full">
              <label>Icon</label>
              <div class="icon-pick">
                @foreach ($icons as $i)
                  <label title="{{ $i }}"><input type="radio" name="icon" value="{{ $i }}" @checked($icon === $i)><span><i class="bi bi-{{ $i }}"></i></span></label>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-head">
            <div><h3><span class="step-no">2</span>What goes inside</h3><p>Most boxes need one list. Add another list only if the box has small sub-headings (like “Awards”).</p></div>
          </div>
          <div class="card-body stack" data-repeat="block-tpl">
            @foreach ($blocks as $i => $block)
              @include('admin.cv.block', ['i' => $i, 'block' => $block])
            @endforeach
          </div>
          <div class="card-body" style="padding-top:0">
            <button type="button" class="btn" data-repeat-add="block-tpl"><i class="bi bi-plus-lg"></i>Add another list in this box</button>
          </div>
        </div>
      </div>

      <div class="stack">
        <div class="card">
          <div class="card-head"><h3><span class="step-no">3</span>Position</h3></div>
          <div class="card-body">
            <x-admin.select name="after" label="Show this box" :options="$positions" :value="$after" :full="true"
              hint="The website puts the boxes into two columns by itself." />
          </div>
        </div>

        <div class="card">
          <div class="card-head"><h3><i class="bi bi-lightbulb" style="color:var(--orange)"></i> How to write the items</h3></div>
          <div class="card-body cv-help">
            <p><strong>List with years</strong>: one item per line, year first, then <b>|</b></p>
            <pre>2003 | Workshop on puppet making, Edinburgh
2008 | Musical workshop, Bahia, Brazil</pre>
            <p><strong>Small tags</strong>: one tag per line</p>
            <pre>Scotland
Brazil
Japan</pre>
            <p><strong>Paragraph</strong>: normal text, one paragraph per line.</p>
            <p><strong>Website links</strong>: name, then <b>|</b>, then the link</p>
            <pre>Facebook | https://facebook.com/…</pre>
          </div>
        </div>
      </div>
    </div>
  </form>

  <template id="block-tpl">@include('admin.cv.block', ['i' => '__i__', 'block' => ['type' => 'timeline']])</template>
@endsection
