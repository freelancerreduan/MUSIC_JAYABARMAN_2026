<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('admin.partials.pagination');

        View::composer('layouts.site', function ($view) {
            $view->with('navPages', Page::where('show_in_nav', true)->orderBy('sort_order')->get());
        });

        View::composer('layouts.admin', function ($view) {
            $view->with('unreadMessages', Message::unread()->latest()->take(6)->get())
                ->with('unreadCount', Message::unread()->count());
        });
    }
}
