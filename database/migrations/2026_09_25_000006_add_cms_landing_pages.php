<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        DB::table('pages')->insertOrIgnore([
            [
                'title' => 'Berita',
                'slug' => 'berita',
                'category' => 'informasi',
                'excerpt' => 'Ikuti kabar, agenda, dan informasi terbaru Program Studi.',
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pengumuman',
                'slug' => 'pengumuman',
                'category' => 'informasi',
                'excerpt' => 'Pengumuman resmi dan informasi penting untuk sivitas akademika.',
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Staff Akademik',
                'slug' => 'staff-akademik',
                'category' => 'akademik',
                'excerpt' => 'Kenali staff akademik yang menghadirkan pengalaman belajar dan layanan terbaik.',
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        // Preserve landing-page content that may have been edited after migration.
    }
};
