<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SitemapController;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/berita', [PostController::class, 'index'])->defaults('type', 'news')->name('posts.news');
Route::get('/pengumuman', [PostController::class, 'index'])->defaults('type', 'announcement')->name('posts.announcements');
Route::get('/informasi/{type}', [PostController::class, 'index'])->whereIn('type', ['news', 'announcement'])->name('posts.index');
Route::get('/konten/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/staff', [PageController::class, 'staff'])->name('staff.index');
Route::get('/e-learning', function () {
    return redirect()->away(SiteSetting::current()->lms_url ?: 'https://lms.uinsgd.ac.id');
})->name('elearning');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/robots.txt', function () {
    return response("User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: " . route('sitemap') . "\n", 200)
        ->header('Content-Type', 'text/plain');
})->name('robots');
Route::get('/profil/{slug}', [PageController::class, 'show'])->name('pages.show');
