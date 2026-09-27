# CMS Web Profil — Laravel + Filament

CMS web profil untuk program studi UIN Sunan Gunung Djati Bandung. Aplikasi ini menggunakan Laravel 12, Filament 4, Livewire, dan SQLite untuk setup awal.

## Instalasi

Lihat [Panduan Instalasi](docs/INSTALASI.md) untuk deployment lewat SSH/Terminal atau cPanel, termasuk konfigurasi database, document root, storage, dan pembuatan admin pertama.

## Menjalankan lokal

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan make:filament-user
php artisan storage:link
php artisan serve
```

Buka `http://127.0.0.1:8000` untuk halaman publik dan `http://127.0.0.1:8000/ptipdpanel/login` untuk CMS. Seeder lokal membuat akun demo `admin@prodi.uinsgd.ac.id` dengan password `password`; ganti segera dan jangan gunakan kredensial demo di server publik.

Untuk pembaruan manual yang mempertahankan database dan konten klien, ikuti [Panduan Update Klien](docs/UPDATE-KLIEN.md). Tombol update otomatis belum aktif sampai sumber rilis tepercaya ditetapkan.

## Modul CMS

- Identitas & SEO: nama situs, logo, favicon, tautan header atas, gambar/gradasi hero dan pengumuman, redaksi/sertifikat akreditasi, warna footer, kontak, sosial media, metadata default, lokasi, LMS, dan endpoint WordPress.
- Halaman Profil: sambutan ketua prodi, visi misi, sejarah, struktur organisasi, kurikulum, journal, dan kontak.
- Editor konten: RichEditor bawaan Filament berbasis Tiptap, berlisensi open-source, tanpa layanan berbayar atau integrasi editor tambahan. Mendukung format teks, heading, alignment, daftar, tautan, tabel, dan unggah gambar.
- Halaman non-Beranda: konten halaman profil, akademik, publikasi, kontak, halaman staff, serta pengantar arsip berita/pengumuman bisa diubah dari menu Halaman Profil. Beranda tetap memakai pengaturan khusus identitas dan hero.
- Berita & Pengumuman: editor rich text, gambar, slug, status publikasi, unggulan, tanggal terbit, dan SEO per konten.
- Akreditasi Prodi: jenjang, status, skor, nomor SK, masa berlaku, logo, dan urutan tampil.
- Staff Akademik: profil, jabatan, kategori, foto, pendidikan, kontak, dan urutan tampil.

## SEO dan integrasi

- Meta title, description, keywords, canonical, Open Graph, Twitter Card.
- JSON-LD `EducationalOrganization`, `WebPage`, `CollectionPage`, dan `Article`.
- Sitemap dinamis di `/sitemap.xml` dan robots di `/robots.txt`.
- Berita UIN diambil dari endpoint WordPress `_embed&per_page=3`, dicache 30 menit, dan memiliki fallback aman ketika API tidak tersedia.
- Gambar yang dikelola CMS disimpan di disk `public` melalui `storage:link`.
- HTML hasil editor dirender dengan sanitizer Filament untuk membantu mencegah konten berbahaya tampil di halaman publik.
