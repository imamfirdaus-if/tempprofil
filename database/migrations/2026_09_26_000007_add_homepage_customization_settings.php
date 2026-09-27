<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('topbar_text')->nullable();
            $table->json('top_links')->nullable();
            $table->string('hero_gradient_start', 7)->default('#147d66');
            $table->string('hero_gradient_middle', 7)->default('#248db0');
            $table->string('hero_gradient_end', 7)->default('#f4fbf8');
            $table->string('accreditation_image')->nullable();
            $table->string('accreditation_title')->nullable();
            $table->text('accreditation_description')->nullable();
            $table->string('announcement_background_image')->nullable();
            $table->string('announcement_gradient_start', 7)->default('#147d66');
            $table->string('announcement_gradient_middle', 7)->default('#248db0');
            $table->string('announcement_gradient_end', 7)->default('#f4fbf8');
            $table->string('footer_background_color', 7)->default('#092f2d');
            $table->string('footer_text_color', 7)->default('#dce7df');
            $table->string('footer_office_label')->nullable();
            $table->text('footer_credit')->nullable();
        });

        $topLinks = [
            ['label' => 'Website Universitas', 'url' => 'https://uinsgd.ac.id'],
            ['label' => 'PPID Fakultas', 'url' => 'https://ppid.ftk.uinsgd.ac.id'],
            ['label' => 'PPID', 'url' => 'https://ppid.uinsgd.ac.id'],
            ['label' => 'LMS', 'url' => 'https://lms.uinsgd.ac.id'],
            ['label' => 'SALAM', 'url' => 'https://salam.uinsgd.ac.id'],
            ['label' => 'Master', 'url' => 'https://master.uinsgd.ac.id'],
        ];

        DB::table('site_settings')->where('id', 1)->update([
            'topbar_text' => 'Portal resmi program studi · UIN Sunan Gunung Djati Bandung',
            'short_name' => 'Prodi UIN SGD Bandung',
            'tagline' => 'Unggul, Kompetitif, dan Inovatif berbasis Rahmatan Lil Alamin',
            'logo' => 'branding/logo-uin-sgd.png',
            'hero_eyebrow' => 'Selamat datang di website resmi',
            'hero_title' => 'Prodi UIN SGD Bandung',
            'hero_image' => 'branding/gedung-ftk-febi-fu.png',
            'top_links' => json_encode($topLinks, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'accreditation_image' => 'branding/akreditasi-unggul-banpt.png',
            'accreditation_title' => 'Terakreditasi Unggul dari BAN-PT',
            'accreditation_description' => 'UIN Sunan Gunung Djati Bandung mendapatkan status Akreditasi Unggul dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) dengan No. SK:1138/SK/BAN-PT/Ak.KP/PT/V/2024. Capaian ini menandai pengakuan terhadap kualitas pendidikan tinggi yang diselenggarakan.',
            'announcement_background_image' => 'branding/gedung-ftk-febi-fu.png',
            'footer_office_label' => 'Alamat Kantor dan Gedung Perkuliahan',
            'footer_credit' => 'Made with ☕️ and 💝 by PTIPD UIN Sunan Gunung Djati Bandung',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'topbar_text',
                'top_links',
                'hero_gradient_start',
                'hero_gradient_middle',
                'hero_gradient_end',
                'accreditation_image',
                'accreditation_title',
                'accreditation_description',
                'announcement_background_image',
                'announcement_gradient_start',
                'announcement_gradient_middle',
                'announcement_gradient_end',
                'footer_background_color',
                'footer_text_color',
                'footer_office_label',
                'footer_credit',
            ]);
        });
    }
};
