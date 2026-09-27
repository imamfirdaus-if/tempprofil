@extends('layouts.public', [
    'seoTitle' => $settings->meta_title ?: $settings->site_name,
    'seoDescription' => $settings->meta_description ?: $settings->description,
    'jsonLd' => [
        '@context' => 'https://schema.org', '@type' => 'EducationalOrganization',
        'name' => $settings->site_name, 'url' => url('/'), 'logo' => $settings->logo,
        'description' => $settings->description, 'telephone' => $settings->phone,
        'address' => ['@type' => 'PostalAddress', 'streetAddress' => $settings->address, 'postalCode' => $settings->postal_code, 'addressCountry' => 'ID'],
        'sameAs' => array_values(array_filter([$settings->instagram, $settings->facebook, $settings->youtube, $settings->x_url])),
    ],
])

@section('content')
    @php
        $assetUrl = fn (?string $path) => $path
            ? (filter_var($path, FILTER_VALIDATE_URL) ? $path : asset('storage/' . $path))
            : null;
        $heroImage = $assetUrl($settings->hero_image);
        $accreditationImage = $assetUrl($settings->accreditation_image);
        $announcementImage = $assetUrl($settings->announcement_background_image);
    @endphp

    <section class="hero" style="--hero-gradient-start: {{ $settings->hero_gradient_start ?: '#147d66' }}; --hero-gradient-middle: {{ $settings->hero_gradient_middle ?: '#248db0' }}; --hero-gradient-end: {{ $settings->hero_gradient_end ?: '#f4fbf8' }}">
        @if($heroImage)<div class="hero-image" style="background-image: url('{{ $heroImage }}')" aria-hidden="true"></div>@endif
        <div class="container hero-inner">
            <div class="hero-content">
                <p class="eyebrow">{{ $settings->hero_eyebrow ?: 'Selamat datang di website resmi' }}</p>
                <h1>{{ $settings->short_name ?: 'Prodi UIN SGD Bandung' }}</h1>
                @if($settings->hero_subtitle)<p class="hero-subtitle">{{ $settings->hero_subtitle }}</p>@endif
                <div class="hero-actions">
                    <a class="button button-light" href="{{ $settings->hero_cta_url ?: route('pages.show', 'visi-misi') }}">{{ $settings->hero_cta_text ?: 'Kenali program studi' }} <span>↗</span></a>
                    <a class="text-link light" href="#informasi">Lihat informasi terbaru <span>↓</span></a>
                </div>
            </div>
        </div>
    </section>

    <section class="accreditation-strip">
        <div class="container accreditation-inner">
            <div class="section-kicker">01 / AKREDITASI</div>
            @if($accreditationImage)
                <figure class="accreditation-certificate"><img src="{{ $accreditationImage }}" alt="Sertifikat Akreditasi Unggul UIN Sunan Gunung Djati Bandung dari BAN-PT" loading="lazy"></figure>
            @endif
            <div class="accreditation-copy">
                <div>
                    <h2>{{ $settings->accreditation_title ?: 'Terakreditasi Unggul dari BAN-PT' }}</h2>
                    <p>{{ $settings->accreditation_description }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section news-section" id="informasi"><div class="container"><div class="section-heading"><div><div class="section-kicker">02 / INFORMASI</div><h2>Berita <em>terkini.</em></h2></div><a class="text-link" href="{{ route('posts.news') }}">Lihat semua berita <span>↗</span></a></div><div class="editorial-grid">@forelse($news as $post) @include('partials.post-card', ['post' => $post, 'featured' => $loop->first]) @empty<div class="empty-state">Belum ada berita yang dipublikasikan.</div>@endforelse</div></div></section>

    <section class="section uin-section"><div class="container"><div class="section-heading"><div><div class="section-kicker">03 / KABAR KAMPUS</div><h2>Berita <em>UIN.</em></h2></div><a class="text-link" href="https://uinsgd.ac.id" target="_blank" rel="noopener">Kunjungi uinsgd.ac.id <span>↗</span></a></div><div class="external-grid">@forelse($externalNews as $item)<a class="external-card" href="{{ $item['url'] }}" target="_blank" rel="noopener">@if($item['image'])<img src="{{ $item['image'] }}" alt="" loading="lazy">@else<div class="image-placeholder plum">UIN</div>@endif<div class="external-card-body"><span class="card-tag">UIN SGD BANDUNG</span><h3>{{ $item['title'] }}</h3><p>{{ $item['excerpt'] }}</p><span class="read-more">Baca di uinsgd.ac.id ↗</span></div></a>@empty<div class="empty-state">Feed berita UIN sedang tidak tersedia. Silakan kunjungi <a href="https://uinsgd.ac.id" target="_blank" rel="noopener">uinsgd.ac.id</a>.</div>@endforelse</div></div></section>

    <section class="section announcement-section" style="--announcement-gradient-start: {{ $settings->announcement_gradient_start ?: '#147d66' }}; --announcement-gradient-middle: {{ $settings->announcement_gradient_middle ?: '#248db0' }}; --announcement-gradient-end: {{ $settings->announcement_gradient_end ?: '#f4fbf8' }}">
        @if($announcementImage)<div class="announcement-background" style="background-image: url('{{ $announcementImage }}')" aria-hidden="true"></div>@endif
        <div class="container"><div class="section-heading"><div><div class="section-kicker">04 / AGENDA</div><h2>Pengumuman <em>penting.</em></h2></div><a class="text-link" href="{{ route('posts.announcements') }}">Lihat semua pengumuman <span>↗</span></a></div><div class="editorial-grid">@forelse($announcements as $post) @include('partials.post-card', ['post' => $post, 'featured' => $loop->first]) @empty<div class="empty-state">Belum ada pengumuman yang dipublikasikan.</div>@endforelse</div></div>
    </section>
@endsection
