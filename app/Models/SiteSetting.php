<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'top_links' => 'array',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1], [
            'site_name' => 'Program Studi UIN Sunan Gunung Djati Bandung',
            'short_name' => 'Prodi UIN SGD Bandung',
            'tagline' => 'Unggul, Kompetitif, dan Inovatif berbasis Rahmatan Lil Alamin',
            'logo' => 'branding/logo-uin-sgd.png',
            'topbar_text' => 'Portal resmi program studi · UIN Sunan Gunung Djati Bandung',
            'top_links' => [
                ['label' => 'Website Universitas', 'url' => 'https://uinsgd.ac.id'],
                ['label' => 'PPID Fakultas', 'url' => 'https://ppid.ftk.uinsgd.ac.id'],
                ['label' => 'PPID', 'url' => 'https://ppid.uinsgd.ac.id'],
                ['label' => 'LMS', 'url' => 'https://lms.uinsgd.ac.id'],
                ['label' => 'SALAM', 'url' => 'https://salam.uinsgd.ac.id'],
                ['label' => 'Master', 'url' => 'https://master.uinsgd.ac.id'],
            ],
            'hero_eyebrow' => 'Selamat datang di website resmi',
            'hero_image' => 'branding/gedung-ftk-febi-fu.png',
            'hero_gradient_start' => '#147d66',
            'hero_gradient_middle' => '#248db0',
            'hero_gradient_end' => '#f4fbf8',
            'accreditation_image' => 'branding/akreditasi-unggul-banpt.png',
            'accreditation_title' => 'Terakreditasi Unggul dari BAN-PT',
            'accreditation_description' => 'UIN Sunan Gunung Djati Bandung mendapatkan status Akreditasi Unggul dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) dengan No. SK:1138/SK/BAN-PT/Ak.KP/PT/V/2024. Capaian ini menandai pengakuan terhadap kualitas pendidikan tinggi yang diselenggarakan.',
            'announcement_background_image' => 'branding/gedung-ftk-febi-fu.png',
            'announcement_gradient_start' => '#147d66',
            'announcement_gradient_middle' => '#248db0',
            'announcement_gradient_end' => '#f4fbf8',
            'footer_office_label' => 'Alamat Kantor dan Gedung Perkuliahan',
            'footer_credit' => 'Made with ☕️ and 💝 by PTIPD UIN Sunan Gunung Djati Bandung',
            'lms_url' => 'https://lms.uinsgd.ac.id',
            'wordpress_api_url' => 'https://uinsgd.ac.id/wp-json/wp/v2/posts?_embed&per_page=3',
        ]);
    }
}
