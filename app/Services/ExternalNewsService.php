<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ExternalNewsService
{
    public function latest(string $endpoint, int $limit = 3): Collection
    {
        $cacheKey = 'external-news:' . md5($endpoint . ':' . $limit);

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($endpoint, $limit) {
            try {
                $response = Http::acceptJson()
                    ->timeout(8)
                    ->retry(2, 200)
                    ->get($endpoint);

                if (! $response->successful()) {
                    return collect();
                }

                return collect($response->json())
                    ->take($limit)
                    ->map(function (array $post): array {
                        $media = data_get($post, '_embedded.wp:featuredmedia.0');
                        $content = (string) data_get($post, 'content.rendered', '');

                        return [
                            'title' => Str::of((string) data_get($post, 'title.rendered', 'Berita UIN'))
                                ->stripTags()
                                ->squish()
                                ->toString(),
                            'excerpt' => Str::of((string) data_get($post, 'excerpt.rendered', $content))
                                ->stripTags()
                                ->squish()
                                ->limit(150)
                                ->toString(),
                            'url' => data_get($post, 'link', '#'),
                            'image' => data_get($media, 'source_url'),
                            'date' => data_get($post, 'date'),
                        ];
                    });
            } catch (\Throwable) {
                return collect();
            }
        });
    }
}
