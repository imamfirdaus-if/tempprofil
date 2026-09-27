<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Staff;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('posts.index', ['type' => 'news']), 'lastmod' => now()->toAtomString()],
            ['loc' => route('posts.index', ['type' => 'announcement']), 'lastmod' => now()->toAtomString()],
            ['loc' => route('staff.index'), 'lastmod' => now()->toAtomString()],
        ]);

        Page::published()->get(['slug', 'updated_at'])->each(fn (Page $page) => $urls->push([
            'loc' => route('pages.show', $page->slug),
            'lastmod' => $page->updated_at?->toAtomString(),
        ]));

        Post::published()->get(['slug', 'updated_at'])->each(fn (Post $post) => $urls->push([
            'loc' => route('posts.show', $post),
            'lastmod' => $post->updated_at?->toAtomString(),
        ]));

        $xml = view('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
