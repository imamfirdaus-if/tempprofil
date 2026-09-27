<?php

namespace Database\Seeders;

use App\Models\Accreditation;
use App\Models\Page;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->isProduction()) {
            User::updateOrCreate(
                ['email' => 'admin@prodi.uinsgd.ac.id'],
                ['name' => 'Administrator Prodi', 'password' => Hash::make('password')],
            );
        }

        SiteSetting::updateOrCreate(['id' => 1], [
            'site_name' => 'Program Studi UIN Sunan Gunung Djati Bandung',
            'short_name' => 'Prodi UIN SGD Bandung',
            'tagline' => 'Unggul, Kompetitif, dan Inovatif berbasis Rahmatan Lil Alamin',
            'description' => 'Portal resmi Program Studi di lingkungan UIN Sunan Gunung Djati Bandung.',
            'topbar_text' => 'Portal resmi program studi · UIN Sunan Gunung Djati Bandung',
            'hero_eyebrow' => 'Selamat datang di website resmi',
            'hero_title' => 'Prodi UIN SGD Bandung',
            'hero_subtitle' => 'Jelajahi informasi program studi, layanan akademik, berita, dan karya ilmiah dalam satu ruang digital.',
            'hero_image' => 'branding/gedung-ftk-febi-fu.png',
            'logo' => 'branding/logo-uin-sgd.png',
            'hero_cta_text' => 'Kenali program studi',
            'hero_cta_url' => '/profil/visi-misi',
            'top_links' => [
                ['label' => 'Website Universitas', 'url' => 'https://uinsgd.ac.id'],
                ['label' => 'PPID Fakultas', 'url' => 'https://ppid.ftk.uinsgd.ac.id'],
                ['label' => 'PPID', 'url' => 'https://ppid.uinsgd.ac.id'],
                ['label' => 'LMS', 'url' => 'https://lms.uinsgd.ac.id'],
                ['label' => 'SALAM', 'url' => 'https://salam.uinsgd.ac.id'],
                ['label' => 'Master', 'url' => 'https://master.uinsgd.ac.id'],
            ],
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
            'footer_background_color' => '#092f2d',
            'footer_text_color' => '#dce7df',
            'footer_office_label' => 'Alamat Kantor dan Gedung Perkuliahan',
            'footer_credit' => 'Made with ☕️ and 💝 by PTIPD UIN Sunan Gunung Djati Bandung',
            'email' => 'info@prodi.uinsgd.ac.id',
            'phone' => '+62 22 7800525',
            'address' => 'Jl. Soekarno-Hatta No. 728, Cibiru, Kota Bandung, Jawa Barat 40614',
            'maps_url' => 'https://maps.google.com/?q=UIN+Sunan+Gunung+Djati+Bandung',
            'lms_url' => 'https://lms.uinsgd.ac.id',
            'wordpress_api_url' => 'https://uinsgd.ac.id/wp-json/wp/v2/posts?_embed&per_page=3',
            'instagram' => 'https://instagram.com/uinsgd',
            'youtube' => 'https://youtube.com/@uinsgd',
            'meta_title' => 'Program Studi UIN Sunan Gunung Djati Bandung',
            'meta_description' => 'Website resmi Program Studi UIN Sunan Gunung Djati Bandung: profil, akademik, berita, pengumuman, dan publikasi.',
            'meta_keywords' => 'program studi, UIN SGD Bandung, akademik, berita, pengumuman, publikasi',
        ]);

        $pages = [
            ['title' => 'Sambutan Ketua Prodi', 'slug' => 'sambutan-ketua-prodi', 'category' => 'profil', 'excerpt' => 'Selamat datang di laman resmi Program Studi.', 'content' => '<p>Assalamu’alaikum warahmatullahi wabarakatuh.</p><p>Selamat datang di laman resmi Program Studi UIN Sunan Gunung Djati Bandung. Website ini kami hadirkan sebagai ruang informasi akademik yang terbuka, mudah diakses, dan relevan bagi mahasiswa, dosen, tenaga kependidikan, alumni, serta masyarakat.</p><p>Mari bersama membangun ekosistem pembelajaran yang berintegritas, adaptif, dan berdampak.</p><p><strong>Ketua Program Studi</strong></p>'],
            ['title' => 'Visi dan Misi', 'slug' => 'visi-misi', 'category' => 'profil', 'excerpt' => 'Arah pengembangan dan komitmen Program Studi.', 'content' => '<h2>Visi</h2><p>Menjadi program studi unggul yang menghasilkan lulusan berintegritas, kompeten, dan responsif terhadap perubahan zaman.</p><h2>Misi</h2><ol><li>Menyelenggarakan pendidikan bermutu dan berpusat pada mahasiswa.</li><li>Mengembangkan penelitian dan publikasi yang bermanfaat bagi masyarakat.</li><li>Memperluas kolaborasi akademik dan profesional.</li><li>Membangun budaya akademik yang inklusif dan berkelanjutan.</li></ol>'],
            ['title' => 'Sejarah', 'slug' => 'sejarah', 'category' => 'profil', 'excerpt' => 'Jejak perjalanan Program Studi dari masa ke masa.', 'content' => '<p>Program Studi tumbuh bersama perkembangan UIN Sunan Gunung Djati Bandung. Sejarahnya dibangun oleh dedikasi para pendiri, dosen, tenaga kependidikan, mahasiswa, dan alumni yang terus menjaga mutu pendidikan.</p><p>Informasi sejarah, tonggak pencapaian, dan perkembangan kelembagaan dapat diperbarui oleh pengelola melalui CMS ini.</p>'],
            ['title' => 'Struktur Organisasi', 'slug' => 'struktur-organisasi', 'category' => 'profil', 'excerpt' => 'Struktur pengelolaan dan tata kerja Program Studi.', 'content' => '<p>Struktur organisasi Program Studi mengedepankan kolaborasi antara pimpinan, sekretariat, dosen, tenaga kependidikan, dan unsur kemahasiswaan.</p><ul><li>Ketua Program Studi</li><li>Sekretaris Program Studi</li><li>Koordinator Akademik dan Kurikulum</li><li>Koordinator Penjaminan Mutu</li><li>Koordinator Kemahasiswaan dan Alumni</li></ul>'],
            ['title' => 'Kurikulum', 'slug' => 'kurikulum', 'category' => 'akademik', 'excerpt' => 'Informasi kurikulum dan proses pembelajaran.', 'content' => '<p>Kurikulum dirancang untuk memastikan capaian pembelajaran lulusan selaras dengan kebutuhan keilmuan, dunia kerja, dan perkembangan teknologi.</p><p>Dokumen kurikulum, panduan akademik, dan berkas pendukung dapat dikelola oleh admin melalui menu Halaman Profil.</p>'],
            ['title' => 'Journal', 'slug' => 'journal', 'category' => 'publikasi', 'excerpt' => 'Ruang publikasi ilmiah dan karya akademik.', 'content' => '<p>Temukan informasi jurnal, call for papers, dan publikasi ilmiah sivitas akademika Program Studi.</p><p>Silakan tambahkan tautan jurnal aktif melalui editor halaman ini.</p>'],
            ['title' => 'Kontak', 'slug' => 'kontak', 'category' => 'kontak', 'excerpt' => 'Hubungi Program Studi untuk informasi lebih lanjut.', 'content' => '<p>Untuk pertanyaan akademik, layanan mahasiswa, kerja sama, dan informasi umum, silakan gunakan kanal kontak resmi yang tercantum pada halaman ini.</p>'],
        ];
        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page + ['is_published' => true]);
        }

        $accreditations = [
            ['program_name' => 'Program Studi Utama', 'degree' => 'Sarjana (S1)', 'level' => 'Unggul', 'status' => 'Terakreditasi Unggul', 'score' => 'A', 'decree_number' => 'SK BAN-PT/1234', 'valid_until' => '2028', 'sort_order' => 1],
            ['program_name' => 'Program Studi Magister', 'degree' => 'Magister (S2)', 'level' => 'Baik Sekali', 'status' => 'Terakreditasi Baik Sekali', 'score' => 'B', 'decree_number' => 'SK BAN-PT/5678', 'valid_until' => '2027', 'sort_order' => 2],
        ];
        foreach ($accreditations as $item) {
            Accreditation::updateOrCreate(['program_name' => $item['program_name']], $item + ['is_active' => true]);
        }

        $staff = [
            ['name' => 'Dr. Aisyah Rahmawati, M.Ag.', 'position' => 'Ketua Program Studi', 'category' => 'Akademik', 'slug' => 'aisyah-rahmawati', 'education' => 'Doktor bidang keilmuan terkait'],
            ['name' => 'Dr. Muhammad Fikri, M.Si.', 'position' => 'Sekretaris Program Studi', 'category' => 'Akademik', 'slug' => 'muhammad-fikri', 'education' => 'Doktor bidang keilmuan terkait'],
            ['name' => 'Siti Nur Azizah, M.Pd.', 'position' => 'Koordinator Akademik', 'category' => 'Akademik', 'slug' => 'siti-nur-azizah', 'education' => 'Magister bidang keilmuan terkait'],
        ];
        foreach ($staff as $index => $person) {
            Staff::updateOrCreate(['slug' => $person['slug']], $person + ['sort_order' => $index, 'is_active' => true]);
        }

        $postSamples = [
            ['type' => 'news', 'title' => 'Program Studi memperkuat kolaborasi akademik untuk pembelajaran berdampak', 'slug' => 'program-studi-memperkuat-kolaborasi-akademik', 'excerpt' => 'Kolaborasi menjadi kunci untuk menghadirkan pengalaman belajar yang relevan.', 'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1200&q=80'],
            ['type' => 'news', 'title' => 'Mahasiswa raih prestasi pada kompetisi inovasi tingkat nasional', 'slug' => 'mahasiswa-raih-prestasi-kompetisi-inovasi', 'excerpt' => 'Capaian mahasiswa menjadi energi baru bagi budaya akademik.', 'image' => 'https://images.unsplash.com/photo-1529390079861-591de354faf5?auto=format&fit=crop&w=1200&q=80'],
            ['type' => 'news', 'title' => 'Dosen berbagi praktik baik riset dan publikasi ilmiah', 'slug' => 'dosen-berbagi-praktik-baik-riset', 'excerpt' => 'Sivitas akademika berbagi pengalaman untuk meningkatkan mutu publikasi.', 'image' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1200&q=80'],
            ['type' => 'news', 'title' => 'Orientasi mahasiswa baru berlangsung hangat dan inspiratif', 'slug' => 'orientasi-mahasiswa-baru-inspiratif', 'excerpt' => 'Mahasiswa baru mengenal lingkungan akademik dan budaya kampus.', 'image' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=1200&q=80'],
            ['type' => 'announcement', 'title' => 'Jadwal registrasi akademik semester berjalan', 'slug' => 'jadwal-registrasi-akademik-semester-berjalan', 'excerpt' => 'Perhatikan jadwal dan kelengkapan dokumen sebelum melakukan registrasi.', 'image' => 'https://images.unsplash.com/photo-1456324504439-367cee3b3c32?auto=format&fit=crop&w=1200&q=80'],
            ['type' => 'announcement', 'title' => 'Pendaftaran seminar proposal dan ujian akhir', 'slug' => 'pendaftaran-seminar-proposal-dan-ujian-akhir', 'excerpt' => 'Informasi pendaftaran dan dokumen pendukung tersedia di sini.', 'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=1200&q=80'],
            ['type' => 'announcement', 'title' => 'Pemutakhiran data mahasiswa dan kontak darurat', 'slug' => 'pemutakhiran-data-mahasiswa', 'excerpt' => 'Pastikan data pribadi dan kontak dapat dihubungi selalu mutakhir.', 'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80'],
            ['type' => 'announcement', 'title' => 'Panggilan partisipasi kegiatan kemahasiswaan', 'slug' => 'panggilan-partisipasi-kegiatan-kemahasiswaan', 'excerpt' => 'Mari berpartisipasi dalam kegiatan pengembangan minat dan bakat.', 'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1200&q=80'],
        ];
        foreach ($postSamples as $index => $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post + [
                'content' => '<p>' . e($post['excerpt']) . '</p><p>Informasi lengkap mengenai kegiatan ini dapat diperbarui melalui CMS oleh admin Program Studi.</p>',
                'published_at' => now()->subDays($index + 1),
                'is_featured' => $index % 4 === 0,
                'is_published' => true,
            ]);
        }
    }
}
