<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// ---------- Public website ----------
Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/project', 'project')->name('project');
    Route::get('/performance', 'performance')->name('performance');
    Route::get('/interview', 'interview')->name('interview');
    Route::get('/news-views', 'news')->name('news');
    Route::get('/portfolio', 'portfolio')->name('portfolio');
    Route::get('/archive', 'archive')->name('archive');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
});
Route::post('/contact', [SiteController::class, 'sendMessage'])->middleware('throttle:5,1')->name('contact.send');

// Old .html links keep working
foreach (['index', 'project', 'performance', 'interview', 'news-views', 'portfolio', 'archive', 'about', 'contact'] as $file) {
    Route::permanentRedirect("/{$file}.html", $file === 'index' ? '/' : "/{$file}");
}

// ---------- Admin ----------
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login'])->middleware('throttle:6,1');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [Admin\ProfileController::class, 'edit'])->name('profile');
    Route::put('profile', [Admin\ProfileController::class, 'update']);

    // Content of each section
    Route::get('home-about', [Admin\ProfileContentController::class, 'edit'])->name('home-about');
    Route::put('home-about', [Admin\ProfileContentController::class, 'update']);
    Route::resource('works', Admin\FeaturedWorkController::class)->except('show');
    Route::resource('videos', Admin\VideoController::class)->except('show');
    Route::resource('concerts', Admin\ConcertController::class)->except('show');
    Route::resource('media', Admin\MediaItemController::class)->except('show')->parameters(['media' => 'medium']);
    Route::resource('photos', Admin\PhotoController::class)->except('show');
    Route::resource('archive', Admin\ArchiveItemController::class)->except('show')->parameters(['archive' => 'item']);
    Route::resource('cv', Admin\CvSectionController::class)->except('show')->parameters(['cv' => 'section']);
    Route::resource('affiliations', Admin\AffiliationController::class)->except('show');

    // Contact form messages
    Route::get('messages', [Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [Admin\MessageController::class, 'show'])->name('messages.show');
    Route::patch('messages/{message}/toggle', [Admin\MessageController::class, 'toggle'])->name('messages.toggle');
    Route::delete('messages/{message}', [Admin\MessageController::class, 'destroy'])->name('messages.destroy');
});
