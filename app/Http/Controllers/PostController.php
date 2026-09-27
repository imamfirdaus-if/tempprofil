<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(string $type = Post::TYPE_NEWS)
    {
        abort_unless(in_array($type, [Post::TYPE_NEWS, Post::TYPE_ANNOUNCEMENT], true), 404);

        $settings = SiteSetting::current();
        $posts = Post::published()->ofType($type)->latest('published_at')->latest()->paginate(9)->withQueryString();
        $landingPage = Page::published()->where('slug', $type === Post::TYPE_ANNOUNCEMENT ? 'pengumuman' : 'berita')->first();
        $title = $landingPage?->title ?: ($type === Post::TYPE_ANNOUNCEMENT ? 'Pengumuman' : 'Berita');
        $seoTitle = $landingPage?->meta_title ?: $title . ' · ' . $settings->short_name;
        $seoDescription = $landingPage?->meta_description ?: ($landingPage?->excerpt ?: 'Informasi ' . strtolower($title) . ' terbaru dari ' . $settings->site_name . '.');

        return view('posts.index', compact('settings', 'posts', 'type', 'title', 'landingPage', 'seoTitle', 'seoDescription'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published && ($post->published_at === null || $post->published_at->isPast()), 404);

        $settings = SiteSetting::current();
        $related = Post::published()->ofType($post->type)->where('id', '!=', $post->id)->latest('published_at')->take(3)->get();

        return view('posts.show', compact('settings', 'post', 'related'));
    }
}
