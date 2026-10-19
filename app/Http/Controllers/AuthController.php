<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $this->upgradeMd5Password($credentials);

        if (! Auth::attempt($credentials + ['is_active' => true], $request->boolean('remember'))) {
            throw ValidationException::withMessages(['email' => 'These details do not match an active account.']);
        }

        $request->session()->regenerate();
        $request->user()->forceFill(['last_login_at' => now()])->saveQuietly();
        ActivityLog::record('login', $request->user(), 'Signed in');

        return redirect()->intended(route('admin.dashboard'));
    }

    // A password set straight in the database as MD5 would crash the Bcrypt check,
    // so when the MD5 matches, store it again as Bcrypt before signing in
    private function upgradeMd5Password(array $credentials): void
    {
        $user = User::where('email', $credentials['email'])->first();

        if ($user && preg_match('/^[a-f0-9]{32}$/i', $user->password)
            && hash_equals(strtolower($user->password), md5($credentials['password']))) {
            $user->forceFill(['password' => Hash::make($credentials['password'])])->saveQuietly();
        }
    }

    public function logout(Request $request)
    {
        ActivityLog::record('logout', $request->user(), 'Signed out');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
