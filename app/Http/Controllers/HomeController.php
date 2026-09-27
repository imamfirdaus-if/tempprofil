<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SiteSetting;
use App\Services\ExternalNewsService;

class HomeController extends Controller
{
    public function __invoke(ExternalNewsService $externalNews)
    {
        $settings = SiteSetting::current();
        $news = Post::published()->ofType(Post::TYPE_NEWS)->latest('published_at')->latest()->take(5)->get();
        $announcements = Post::published()->ofType(Post::TYPE_ANNOUNCEMENT)->latest('published_at')->latest()->take(5)->get();
        $externalNews = $externalNews->latest($settings->wordpress_api_url ?: config('services.wordpress.endpoint'), 3);

        return view('home', compact('settings', 'news', 'announcements', 'externalNews'));
    }
}
