<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class UinNewsSamplesSeeder extends Seeder
{
    public function run(): void
    {
        // Keep the original demo records recoverable, but remove them from the public site.
        Post::query()
            ->whereIn('slug', [
                'program-studi-memperkuat-kolaborasi-akademik',
                'mahasiswa-raih-prestasi-kompetisi-inovasi',
                'dosen-berbagi-praktik-baik-riset',
                'orientasi-mahasiswa-baru-inspiratif',
                'jadwal-registrasi-akademik-semester-berjalan',
                'pendaftaran-seminar-proposal-dan-ujian-akhir',
                'pemutakhiran-data-mahasiswa',
                'panggilan-partisipasi-kegiatan-kemahasiswaan',
            ])
            ->update(['is_published' => false]);

        $samples = [
            [
                'type' => Post::TYPE_NEWS,
                'title' => 'Dosen Mengabdi, Kenalkan Edukasi Sains Energi Terbarukan pada Santri Cilik di Lingkar Kampus',
                'slug' => 'dosen-mengabdi-edukasi-energi-terbarukan-santri-cilik',
                'excerpt' => 'Sekitar 40 santri cilik belajar energi terbarukan melalui eksperimen sains sederhana bersama dosen dan mahasiswa UIN Bandung.',
                'meta_title' => 'Dosen Mengabdi: Edukasi Energi Terbarukan untuk Santri',
                'meta_description' => 'Dosen UIN SGD mengenalkan energi terbarukan melalui eksperimen generator termoelektrik kepada sekitar 40 santri cilik di lingkar kampus.',
                'published_at' => '2026-09-26 12:00:00',
                'summary' => 'Sekitar 40 santri usia sekolah dasar di Ma’had Al Miraj, Cipadung, mengikuti kegiatan belajar sains yang mengutamakan praktik langsung. Dosen dan mahasiswa mendampingi mereka mencoba demonstrasi sederhana tentang perubahan energi panas menjadi listrik.',
                'detail' => 'Kegiatan pengabdian kepada masyarakat ini mengenalkan teknologi Thermoelectric Generator (TEG) sebagai contoh pemanfaatan energi terbarukan. Pendekatan belajar sambil mencoba membantu peserta memahami konsep sains melalui pengalaman yang dekat dan menyenangkan.',
                'source_url' => 'https://uinsgd.ac.id/dosen-mengabdi-kenalkan-edukasi-sains-energi-terbarukan-pada-santri-cilik-di-lingkar-kampus/',
            ],
            [
                'type' => Post::TYPE_NEWS,
                'title' => 'Merajut Solidaritas, Palestina di Titik Sentral IGIC 2026',
                'slug' => 'merajut-solidaritas-palestina-igic-2026',
                'excerpt' => 'International Grand Imam Conference 2026 mengangkat dialog keagamaan, solidaritas kemanusiaan, dan dukungan bagi Palestina.',
                'meta_title' => 'IGIC 2026: Solidaritas untuk Palestina',
                'meta_description' => 'IGIC 2026 menjadi ruang dialog keagamaan dan solidaritas kemanusiaan untuk mendukung perdamaian serta kemerdekaan Palestina.',
                'published_at' => '2026-09-26 11:00:00',
                'summary' => 'International Grand Imam Conference (IGIC) 2026 di Masjid Istiqlal menjadi ruang pertemuan tokoh agama untuk memperkuat dialog lintas iman dan solidaritas kemanusiaan. Palestina menjadi salah satu perhatian utama dalam pembahasan perdamaian dan hak-hak masyarakatnya.',
                'detail' => 'Dalam rangkaian konferensi, pemerintah Indonesia menyampaikan dukungan bagi Palestina, termasuk melalui perhatian pada pendidikan generasi muda. Forum ini menempatkan kerja sama dan percakapan antarumat beragama sebagai bagian dari upaya membangun perdamaian.',
                'source_url' => 'https://uinsgd.ac.id/merajut-solidaritas-palestina-di-titik-sentral-igic-2026/',
            ],
            [
                'type' => Post::TYPE_NEWS,
                'title' => 'UIN Bandung Jadi Lokus Kurikulum Berbasis Cinta, Peserta PKN II Kemenag Cari Model Kepemimpinan Adaptif dan Berdampak',
                'slug' => 'uin-bandung-lokus-kurikulum-berbasis-cinta-pkn-ii-kemenag',
                'excerpt' => 'Sebanyak 15 peserta PKN Tingkat II Kementerian Agama mempelajari kepemimpinan adaptif dan penerapan Kurikulum Berbasis Cinta di UIN Bandung.',
                'meta_title' => 'UIN Bandung Jadi Lokus Kurikulum Berbasis Cinta',
                'meta_description' => 'UIN Bandung menjadi lokus Visitasi Kepemimpinan Nasional PKN II Kemenag dengan fokus Kurikulum Berbasis Cinta dan kepemimpinan adaptif.',
                'published_at' => '2026-09-25 12:00:00',
                'summary' => 'UIN Sunan Gunung Djati Bandung menjadi lokasi Visitasi Kepemimpinan Nasional bagi 15 peserta Pelatihan Kepemimpinan Nasional Tingkat II Angkatan XXI Kementerian Agama. Kegiatan tersebut menyoroti praktik kepemimpinan yang adaptif, humanis, dan berdampak.',
                'detail' => 'Agenda ini mengangkat Kurikulum Berbasis Cinta sebagai salah satu model yang dipelajari peserta. Rangkaian pelatihan berlangsung secara bauran dan menghubungkan penguatan kerukunan, cinta kemanusiaan, serta pendekatan ekoteologi.',
                'source_url' => 'https://uinsgd.ac.id/uin-bandung-jadi-lokus-kurikulum-berbasis-cinta-peserta-pkn-ii-kemenag-cari-model-kepemimpinan-adaptif-dan-berdampak/',
            ],
            [
                'type' => Post::TYPE_NEWS,
                'title' => 'Kuliah Lapangan Magister Studi Agama-Agama: Menemukan Makna Spiritual dalam Tradisi Nyangu Masyarakat Penghayat Kepercayaan Perjalanan',
                'slug' => 'kuliah-lapangan-magister-saa-tradisi-nyangu',
                'excerpt' => 'Mahasiswa Magister Studi Agama-Agama mengamati tradisi nyangu dan nilai spiritualnya bersama masyarakat Penghayat Kepercayaan Perjalanan.',
                'meta_title' => 'Kuliah Lapangan Magister SAA dan Tradisi Nyangu',
                'meta_description' => 'Mahasiswa Magister Studi Agama-Agama belajar tradisi nyangu langsung bersama masyarakat Penghayat Kepercayaan Perjalanan di Bandung Barat.',
                'published_at' => '2026-09-25 11:00:00',
                'summary' => 'Sebanyak 15 mahasiswa semester tiga Magister Studi Agama-Agama mengikuti kuliah lapangan di Pasewakan Wangun Sari Jati Mandiri, Kabupaten Bandung Barat. Mereka berinteraksi langsung dengan masyarakat Penghayat Kepercayaan Perjalanan untuk memahami praktik keagamaan dalam konteks keseharian.',
                'detail' => 'Salah satu kegiatan yang dipelajari adalah nyangu atau proses memasak nasi. Tahapan dan perlengkapannya dipahami bukan hanya sebagai keterampilan memasak, tetapi juga sebagai praktik yang memuat tata krama, doa, serta penghormatan terhadap alam dan kehidupan.',
                'source_url' => 'https://uinsgd.ac.id/kuliah-lapangan-magister-studi-agama-agama-menemukan-makna-spiritual-dalam-tradisi-nyangu-masyarakat-penghayat-kepercayaan-perjalanan/',
            ],
            [
                'type' => Post::TYPE_NEWS,
                'title' => 'Siapkan Generasi Qurani yang Melek Digital, Prodi Eksyar Gelar PkM Tata Kelola Masjid di Garut',
                'slug' => 'prodi-eksyar-pkm-literasi-digital-tata-kelola-masjid-garut',
                'excerpt' => 'Prodi Ekonomi Syariah mengadakan pelatihan literasi keuangan digital dan tata kelola aset bagi pengurus 40 masjid di Garut.',
                'meta_title' => 'PkM Eksyar: Literasi Keuangan Digital di Garut',
                'meta_description' => 'Prodi Ekonomi Syariah mengadakan literasi keuangan digital dan tata kelola aset masjid untuk 80 pengurus dari 40 masjid di Garut.',
                'published_at' => '2026-09-25 10:00:00',
                'summary' => 'Program Studi Ekonomi Syariah UIN Bandung menggelar pengabdian kepada masyarakat di Masjid Agung Syekh Ja’far Shiddiq, Garut. Kegiatan membahas literasi digitalisasi keuangan syariah dan pengelolaan aset masjid yang akuntabel.',
                'detail' => 'Sekitar 80 pengurus dari 40 masjid mengikuti kegiatan yang melibatkan mitra lintas sektor, termasuk Bank Indonesia dan Bank Muamalat. Materi dirancang untuk membantu pengurus memahami pemanfaatan teknologi dan tata kelola keuangan secara bijak.',
                'source_url' => 'https://uinsgd.ac.id/siapkan-generasi-qurani-yang-melek-digital-prodi-eksyar-gelar-pkm-tata-kelola-masjid-di-garut/',
            ],
            [
                'type' => Post::TYPE_ANNOUNCEMENT,
                'title' => 'Informasi Penyesuaian UKT Mahasiswa Baru S1 2026: Simak Mekanisme, Pendaftaran, dan Pengumuman Hasilnya',
                'slug' => 'informasi-penyesuaian-ukt-mahasiswa-baru-s1-2026',
                'excerpt' => 'UIN Bandung membuka pengajuan penyesuaian kategori UKT bagi mahasiswa baru S1 tahun akademik 2026/2027 melalui aplikasi SIPUKT.',
                'meta_title' => 'Penyesuaian UKT Mahasiswa Baru S1 2026/2027',
                'meta_description' => 'Ringkasan kebijakan penyesuaian UKT mahasiswa baru S1 UIN Bandung 2026/2027. Periksa jadwal dan persyaratan terbaru pada kanal resmi.',
                'published_at' => '2026-09-07 12:00:00',
                'summary' => 'UIN Bandung menyediakan pengajuan penyesuaian kategori UKT bagi mahasiswa baru program sarjana tahun akademik 2026/2027. Kebijakan ini dapat dipertimbangkan, antara lain, jika terdapat kekeliruan data registrasi atau perubahan kemampuan ekonomi orang tua/wali.',
                'detail' => 'Informasi sumber menyebut pengajuan dilakukan melalui SIPUKT dengan akun SSO dan kesempatan diberikan satu kali. Karena jadwal serta ketentuan administrasi dapat berubah, mahasiswa sebaiknya memastikan informasi yang berlaku langsung melalui laman resmi sebelum mengajukan.',
                'source_url' => 'https://uinsgd.ac.id/informasi-penyesuaian-ukt-mahasiswa-baru-s1-2026-simak-mekanisme-pendaftaran-dan-pengumuman-hasilnya/',
            ],
            [
                'type' => Post::TYPE_ANNOUNCEMENT,
                'title' => 'UIN Bandung Klarifikasi Informasi Hoaks Penawaran Kendaraan Atas Nama Rektor',
                'slug' => 'klarifikasi-hoaks-penawaran-kendaraan-atas-nama-rektor',
                'excerpt' => 'Waspadai pesan penawaran kendaraan yang mencatut nama pimpinan UIN Bandung; verifikasi melalui kanal resmi dan jangan bertransaksi.',
                'meta_title' => 'Klarifikasi Hoaks Penawaran Kendaraan Atas Nama Rektor',
                'meta_description' => 'UIN Bandung mengingatkan masyarakat agar memverifikasi pesan yang mengatasnamakan rektor dan tidak mengirim uang atau data pribadi.',
                'published_at' => '2026-08-19 12:00:00',
                'summary' => 'UIN Bandung mengklarifikasi pesan WhatsApp Business yang menggunakan nama dan foto Rektor untuk menawarkan kendaraan dengan harga tidak wajar. Universitas menyatakan pesan tersebut bukan berasal dari pimpinan dan merupakan modus yang mencatut identitas institusi.',
                'detail' => 'Masyarakat, sivitas akademika, dan alumni diimbau untuk tidak mempercayai atau menyebarkan tawaran tersebut. Jangan melakukan pembayaran maupun memberikan data pribadi kepada akun yang belum terverifikasi; konfirmasikan informasi melalui kanal resmi universitas.',
                'source_url' => 'https://uinsgd.ac.id/uin-bandung-klarifikasi-informasi-hoaks-penawaran-kendaraan-atas-nama-rektor/',
            ],
            [
                'type' => Post::TYPE_ANNOUNCEMENT,
                'title' => 'JDIH UIN Bandung Raih Nilai 95 Kategori AA dalam Pengelolaan Informasi Hukum',
                'slug' => 'jdih-uin-bandung-raih-nilai-95-kategori-aa',
                'excerpt' => 'Pengelolaan JDIH UIN Bandung memperoleh nilai 95 kategori AA pada E-Report 2025, meningkat dari nilai 84 pada 2024.',
                'meta_title' => 'JDIH UIN Bandung Raih Nilai 95 Kategori AA',
                'meta_description' => 'JDIH UIN Bandung mencatat nilai 95 kategori AA pada E-Report 2025, mencakup tata kelola dokumen hukum, metadata, teknologi, dan pembaruan.',
                'published_at' => '2026-08-07 12:00:00',
                'summary' => 'Jaringan Dokumentasi dan Informasi Hukum UIN Bandung meraih nilai 95 kategori AA dalam E-Report JDIH 2025. Capaian tersebut meningkat dibanding nilai 84 pada laporan tahun sebelumnya.',
                'detail' => 'Penilaian mencakup tata kelola kelembagaan, konten dan metadata produk hukum, pemanfaatan teknologi informasi, serta keberlanjutan pembaruan. Pengembangan layanan ini ditujukan agar dokumen hukum lebih tertata dan mudah diakses oleh sivitas akademika maupun masyarakat.',
                'source_url' => 'https://uinsgd.ac.id/jdih-uin-bandung-raih-nilai-95-kategori-aa-dari-eka-acalapati-dalam-pengelolaan-informasi-hukum/',
            ],
            [
                'type' => Post::TYPE_ANNOUNCEMENT,
                'title' => 'PTIPD UIN Bandung Jadi Rujukan, UIN STS Jambi Perkuat Sistem Informasi Akademik',
                'slug' => 'ptipd-uin-bandung-rujukan-sistem-informasi-akademik',
                'excerpt' => 'PTIPD UIN Bandung berbagi praktik pengelolaan teknologi dan layanan akademik digital bersama UTIPD UIN STS Jambi.',
                'meta_title' => 'PTIPD UIN Bandung Berbagi Praktik SIA dengan UIN STS Jambi',
                'meta_description' => 'Kolaborasi PTIPD UIN Bandung dan UIN STS Jambi membahas integrasi data, keamanan, keandalan sistem, dan layanan akademik digital.',
                'published_at' => '2026-08-06 12:00:00',
                'summary' => 'PTIPD UIN Bandung berbagi pengalaman pengelolaan teknologi informasi dengan UTIPD UIN Sulthan Thaha Saifuddin Jambi untuk mendukung penguatan Sistem Informasi Akademik. Pertemuan membahas kebutuhan layanan digital bagi mahasiswa, dosen, dan tenaga kependidikan.',
                'detail' => 'Topik diskusi meliputi integrasi data, tata kelola proses akademik, keamanan, infrastruktur, serta pemeliharaan sistem. Praktik yang relevan dapat dipelajari dan disesuaikan dengan kebutuhan masing-masing perguruan tinggi.',
                'source_url' => 'https://uinsgd.ac.id/ptipd-uin-bandung-jadi-rujukan-uin-sts-jambi-perkuat-sistem-informasi-akademik/',
            ],
            [
                'type' => Post::TYPE_ANNOUNCEMENT,
                'title' => 'Informasi Tarif Layanan BLU UIN Sunan Gunung Djati Bandung 2026',
                'slug' => 'informasi-tarif-layanan-blu-uin-sgd-2026',
                'excerpt' => 'UIN Bandung menetapkan tarif layanan BLU tahun 2026 melalui keputusan rektor; rujuk dokumen resmi untuk rincian dan pembaruan.',
                'meta_title' => 'Informasi Tarif Layanan BLU UIN SGD 2026',
                'meta_description' => 'UIN Bandung menetapkan tarif layanan BLU melalui keputusan rektor tahun 2026. Cek dokumen resmi untuk rincian tarif akademik dan penunjang.',
                'published_at' => '2026-06-23 12:00:00',
                'summary' => 'UIN Bandung menyampaikan informasi penetapan tarif layanan Badan Layanan Umum (BLU) melalui Keputusan Rektor Nomor 427/Un.05/II.3/KU.01.1/06/2026. Cakupannya meliputi layanan akademik dan layanan penunjang akademik.',
                'detail' => 'Artikel sumber menjelaskan bahwa kebijakan tarif dimaksudkan untuk mendukung layanan yang efektif, transparan, dan akuntabel. Ringkasan ini tidak mencantumkan besaran biaya; gunakan dokumen resmi dan periksa apakah terdapat pembaruan sebelum menjadikannya acuan pembayaran.',
                'source_url' => 'https://uinsgd.ac.id/informasi-tarif-layanan-blu-uin-sunan-gunung-djati-bandung-2026/',
            ],
        ];

        foreach ($samples as $sample) {
            $content = '<p>' . e($sample['summary']) . '</p>'
                . '<p>' . e($sample['detail']) . '</p>'
                . '<p><strong>Sumber:</strong> <a href="' . e($sample['source_url']) . '" target="_blank" rel="noopener noreferrer">artikel resmi UIN Sunan Gunung Djati Bandung</a>. Ringkasan ini disusun ulang untuk kebutuhan informasi program studi.</p>';

            Post::updateOrCreate(
                ['slug' => $sample['slug']],
                [
                    'type' => $sample['type'],
                    'title' => $sample['title'],
                    'excerpt' => $sample['excerpt'],
                    'content' => $content,
                    'image' => null,
                    'is_featured' => false,
                    'is_published' => true,
                    'published_at' => $sample['published_at'],
                    'author_id' => null,
                    'meta_title' => $sample['meta_title'],
                    'meta_description' => $sample['meta_description'],
                ],
            );
        }
    }
}
