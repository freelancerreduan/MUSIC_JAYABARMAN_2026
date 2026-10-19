@extends('layouts.admin')

@section('title', 'My profile')
@section('subtitle', 'Your account')

@section('content')
  <form method="POST" action="{{ route('admin.profile') }}">
    @csrf @method('PUT')

    <div class="page-head">
      <div><h2>My profile</h2><p>Signed in as {{ $user->email }} · {{ \App\Models\User::ROLES[$user->role] ?? $user->role }}</p></div>
      <div class="actions"><button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button></div>
    </div>

    <div class="grid g-2">
      <div class="card">
        <div class="card-head"><h3>Account</h3></div>
        <div class="card-body form-grid">
          <x-admin.input name="name" label="Name" :value="$user->name" required />
          <x-admin.input name="email" label="Email" type="email" :value="$user->email" required />
        </div>
      </div>
      <div class="card">
        <div class="card-head"><div><h3>Change password</h3><p>Leave empty to keep your password.</p></div></div>
        <div class="card-body form-grid">
          <div class="field full">
            <label for="f_current">Current password</label>
            <input id="f_current" name="current_password" type="password" autocomplete="current-password" @class(['input', 'is-invalid' => $errors->has('current_password')])>
            @error('current_password')<div class="error">{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label for="f_password">New password</label>
            <input id="f_password" name="password" type="password" autocomplete="new-password" @class(['input', 'is-invalid' => $errors->has('password')])>
            @error('password')<div class="error">{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label for="f_password_confirmation">Repeat new password</label>
            <input id="f_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="input">
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
