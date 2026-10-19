<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Support\AdminMenu;

class DashboardController extends Controller
{
    public function index()
    {
        $hour = now()->hour;

        return view('admin.dashboard', [
            'greeting' => $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening'),
            'sections' => AdminMenu::build(auth()->user(), Message::unread()->count())['website'],
            'unread' => Message::unread()->count(),
            'messages' => Message::latest()->take(5)->get(),
        ]);
    }
}
