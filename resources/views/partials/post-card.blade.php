@php
    $cardImage = $post->image && filter_var($post->image, FILTER_VALIDATE_URL) ? $post->image : ($post->image ? asset('storage/' . $post->image) : null);
    $isAnnouncement = $post->type === 'announcement';
@endphp
<a class="post-card {{ $featured ? 'post-card-featured' : 'post-card-compact' }}" href="{{ route('posts.show', $post) }}">
    @if($cardImage)<img src="{{ $cardImage }}" alt="{{ $post->title }}" loading="lazy">@else<div class="image-placeholder {{ $isAnnouncement ? 'sand' : 'green' }}">{{ $isAnnouncement ? 'AGENDA' : 'NEWS' }}</div>@endif
    <div class="post-card-overlay"></div><div class="post-card-content"><div class="post-meta"><span>{{ $isAnnouncement ? 'Pengumuman' : 'Berita' }}</span><time datetime="{{ $post->published_at?->toDateString() }}">{{ $post->published_at?->translatedFormat('d M Y') }}</time></div><h3>{{ $post->title }}</h3>@if($featured)<p>{{ $post->excerpt }}</p>@endif<div class="card-arrow">↗</div></div>
</a>
