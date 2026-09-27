@php
    $siteSettings = $settings ?? \App\Models\SiteSetting::current();
    $pageTitle = $seoTitle ?? $siteSettings->meta_title ?? $siteSettings->site_name;
    $pageDescription = $seoDescription ?? $siteSettings->meta_description ?? $siteSettings->description;
    $ogImage = $seoImage ?? $siteSettings->og_image ?? $siteSettings->hero_image;
    $imageUrl = $ogImage && filter_var($ogImage, FILTER_VALIDATE_URL) ? $ogImage : ($ogImage ? asset('storage/' . $ogImage) : asset('images/og-default.svg'));
    $logoUrl = $siteSettings->logo && filter_var($siteSettings->logo, FILTER_VALIDATE_URL) ? $siteSettings->logo : ($siteSettings->logo ? asset('storage/' . $siteSettings->logo) : null);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $pageDescription }}">
    @if($siteSettings->meta_keywords)<meta name="keywords" content="{{ $siteSettings->meta_keywords }}">@endif
    <meta name="author" content="{{ $siteSettings->site_name }}">
    <meta name="theme-color" content="#0e4a47">
    <link rel="canonical" href="{{ url()->current() }}">
    <title>{{ $pageTitle }}</title>
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="{{ $siteSettings->site_name }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $imageUrl }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $imageUrl }}">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ route('sitemap') }}">
    @if($siteSettings->favicon)
        <link rel="icon" href="{{ filter_var($siteSettings->favicon, FILTER_VALIDATE_URL) ? $siteSettings->favicon : asset('storage/' . $siteSettings->favicon) }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site-overrides.css') }}?v={{ filemtime(public_path('css/site-overrides.css')) }}">
    @stack('head')
    @if(isset($jsonLd))<script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>@endif
</head>
<body>
    <div class="topline">
        <div class="container top-line-inner">
            <span>{{ $siteSettings->topbar_text ?: 'Portal resmi program studi · UIN Sunan Gunung Djati Bandung' }}</span>
            <div class="top-links">
                @foreach($siteSettings->top_links ?? [] as $topLink)
                    @if(filled($topLink['label'] ?? null) && filled($topLink['url'] ?? null))
                        <a href="{{ $topLink['url'] }}" target="_blank" rel="noopener noreferrer">{{ $topLink['label'] }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <header class="site-header">
        <div class="container header-inner">
            <a href="{{ route('home') }}" class="brand" aria-label="{{ $siteSettings->site_name }}">
                @if($logoUrl)<img src="{{ $logoUrl }}" alt="Logo {{ $siteSettings->short_name }}">@else<div class="brand-mark">SGD</div>@endif
                <span class="brand-copy"><strong>{{ $siteSettings->short_name }}</strong><small>UIN Sunan Gunung Djati Bandung</small></span>
            </a>
            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-navigation"><span></span><span></span><span></span><b>Menu</b></button>
            <nav id="main-navigation" class="main-nav" aria-label="Navigasi utama">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <div class="nav-dropdown">
                    <button type="button">Profil Jurusan <span>⌄</span></button>
                    <div class="dropdown-panel">
                        <a href="{{ route('pages.show', 'sambutan-ketua-prodi') }}">Sambutan Ketua Prodi</a>
                        <a href="{{ route('pages.show', 'visi-misi') }}">Visi &amp; Misi</a>
                        <a href="{{ route('pages.show', 'sejarah') }}">Sejarah</a>
                        <a href="{{ route('pages.show', 'struktur-organisasi') }}">Struktur Organisasi</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button type="button">Akademik <span>⌄</span></button>
                    <div class="dropdown-panel">
                        <a href="{{ route('staff.index') }}">Staff Akademik</a>
                        <a href="{{ route('pages.show', 'kurikulum') }}">Kurikulum</a>
                        <a href="{{ route('elearning') }}" target="_blank" rel="noopener">E-learning ↗</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button type="button">Informasi <span>⌄</span></button>
                    <div class="dropdown-panel">
                        <a href="{{ route('posts.news') }}">Berita</a>
                        <a href="{{ route('posts.announcements') }}">Pengumuman</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button type="button">Publikasi <span>⌄</span></button>
                    <div class="dropdown-panel"><a href="{{ route('pages.show', 'journal') }}">Journal</a></div>
                </div>
                <a href="{{ route('pages.show', 'kontak') }}">Kontak</a>
            </nav>
            <a class="header-cta" href="{{ route('pages.show', 'kontak') }}">Hubungi kami <span>↗</span></a>
        </div>
    </header>

    <main>@yield('content')</main>

    <footer class="site-footer" style="--footer-background: {{ $siteSettings->footer_background_color ?: '#092f2d' }}; --footer-text-color: {{ $siteSettings->footer_text_color ?: '#dce7df' }}">
        <div class="container footer-grid">
            <div class="footer-brand">@if($logoUrl)<img class="footer-brand-logo" src="{{ $logoUrl }}" alt="Logo {{ $siteSettings->short_name }}" loading="lazy">@else<div class="brand-mark small">SGD</div>@endif<h2>{{ $siteSettings->short_name }}</h2><p>{{ $siteSettings->tagline ?: 'Unggul, Kompetitif, dan Inovatif berbasis Rahmatan Lil Alamin' }}</p></div>
            <div><p class="footer-label">Jelajah</p><a href="{{ route('pages.show', 'visi-misi') }}">Visi &amp; Misi</a><a href="{{ route('staff.index') }}">Staff Akademik</a><a href="{{ route('pages.show', 'kurikulum') }}">Kurikulum</a><a href="{{ route('pages.show', 'journal') }}">Journal</a></div>
            <div><p class="footer-label">Informasi</p><a href="{{ route('posts.news') }}">Berita</a><a href="{{ route('posts.announcements') }}">Pengumuman</a><a href="{{ route('elearning') }}">E-learning</a><a href="{{ route('pages.show', 'kontak') }}">Kontak</a></div>
            <div class="footer-contact"><p class="footer-label">{{ $siteSettings->footer_office_label ?: 'Alamat Kantor dan Gedung Perkuliahan' }}</p><p>{{ $siteSettings->address }}</p></div>
        </div>
        <div class="container footer-bottom"><span>© {{ date('Y') }} {{ $siteSettings->site_name }}</span><span>{{ $siteSettings->footer_credit ?: 'Made with ☕️ and 💝 by PTIPD UIN Sunan Gunung Djati Bandung' }}</span></div>
    </footer>
    <script>
        const navToggle = document.querySelector('.nav-toggle');
        const nav = document.querySelector('.main-nav');
        navToggle?.addEventListener('click', () => { const expanded = navToggle.getAttribute('aria-expanded') === 'true'; navToggle.setAttribute('aria-expanded', String(!expanded)); nav.classList.toggle('open'); });
        document.querySelectorAll('.nav-dropdown > button').forEach(button => button.addEventListener('click', () => button.parentElement.classList.toggle('open')));
    </script>
    @stack('scripts')
</body>
</html>
