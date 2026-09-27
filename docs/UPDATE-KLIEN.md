# Panduan Update Template untuk Klien

## Kanal update

Kanal yang direncanakan adalah **GitHub Releases pada repository privat `imamfirdaus-if/tempprofil`**. Karena instalasi berada di server yang dikelola pemilik template, setiap server dapat membaca rilis menggunakan token fine-grained yang dibatasi ke repository tersebut dan izin `Contents: Read`. Simpan token hanya pada `.env` server dengan permission file yang ketat; jangan masukkan token ke pengaturan CMS, database, source control, atau browser. GitHub mendokumentasikan izin baca tersebut untuk API rilis dan unduhan release asset.

Tombol update otomatis belum diaktifkan. Implementasi perlu dikonfigurasi dengan repository `owner/repo` yang tepat dan format asset rilis yang disepakati. Jangan memasang paket update dari URL yang bisa diedit pengguna CMS atau dari sumber yang belum diverifikasi: paket tersebut dapat menjalankan kode di server.

Setelah kanal rilis dipilih, rancangan tombol di CMS adalah:

- Hanya role superadmin yang dapat memeriksa dan memasang rilis.
- Token GitHub bersifat read-only, dibatasi pada satu repository, dan diambil dari environment server.
- CMS menampilkan versi saat ini, versi tersedia, catatan rilis, dan konfirmasi sebelum pemasangan.
- Paket diverifikasi terhadap metadata/checksum dan tanda tangan digital dari kunci publik yang tertanam pada aplikasi. Kegagalan verifikasi membatalkan update.
- Proses mencadangkan berkas aplikasi yang akan diganti, mengunduh ke lokasi sementara di luar web root, lalu memasang paket secara atomik agar kegagalan tidak meninggalkan aplikasi setengah ter-update.
- `.env`, database klien, unggahan `storage/app/public`, konfigurasi, dan data/konten CMS tidak ditimpa.
- Tombol tidak menjalankan `migrate`, `db:seed`, `key:generate`, atau operasi perubahan skema/data. Rilis yang membutuhkan perubahan database harus ditahan untuk jalur upgrade terpisah dan persetujuan eksplisit.
- Setelah sukses, cache Laravel dibersihkan/dibangun ulang dan halaman kesehatan aplikasi diperiksa. Jika pemeriksaan gagal, kode dikembalikan dari cadangan.

Update tanpa migrasi membatasi perubahan pada rilis yang kompatibel dengan skema database klien. Perubahan fitur yang memerlukan kolom/tabel baru tidak dapat dibawa melalui tombol ini sampai ada strategi migrasi yang disepakati.

## Update manual sementara

Gunakan prosedur ini sampai kanal rilis dan tombol otomatis tersedia.

1. Jadwalkan pemeliharaan dan pastikan Anda memiliki akses Terminal/SSH atau bantuan penyedia hosting.
2. Cadangkan database klien dan berkas unggahan. Contohnya, ekspor MySQL dari phpMyAdmin/cPanel dan arsipkan `storage/app/public`. Simpan salinan di luar web root.
3. Unduh paket rilis resmi dan pastikan versi serta checksum-nya cocok dengan pengumuman rilis.
4. Aktifkan maintenance mode dari root aplikasi:

   ```bash
   php artisan down
   ```

5. Ekstrak rilis ke direktori sementara, lalu salin/unggah berkas aplikasi yang diperbarui. Pertahankan berkas dan data milik klien berikut:

   - `.env` dan `APP_KEY`;
   - database, termasuk `database/database.sqlite` jika instalasi menggunakan SQLite;
   - seluruh `storage/`, terutama `storage/app/public`;
   - tautan `public/storage`;
   - konfigurasi lokal lain yang dibuat khusus untuk klien.

   Jangan menimpa seluruh direktori instalasi secara membabi buta. Jika paket mengubah `composer.json` atau `composer.lock`, pasang dependency yang tercantum dalam lock file:

   ```bash
   composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
   ```

6. Bersihkan dan bangun ulang cache:

   ```bash
   php artisan optimize:clear
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

7. Uji halaman utama, halaman artikel, sitemap, dan login CMS. Jika lolos, buka kembali situs:

   ```bash
   php artisan up
   ```

Jika update gagal, pertahankan situs dalam maintenance mode bila perlu, pulihkan berkas kode dari cadangan rilis sebelumnya, pulihkan dependency dengan `composer install` untuk lock file sebelumnya, bersihkan cache, lalu verifikasi kembali. Jangan menjalankan `migrate:fresh`, `db:seed`, `key:generate`, atau menghapus `storage` saat proses update.

## Pembaruan melalui cPanel

Alurnya sama: buat backup database dan unggahan, unggah paket ke direktori sementara, gunakan cPanel Terminal untuk perintah Artisan/Composer, dan salin berkas sambil mempertahankan `.env`, database, `storage/`, serta `public/storage`. File Manager saja tidak dapat menjalankan Composer atau perintah Artisan. Bila hosting tidak menyediakan Terminal/SSH, minta administrator hosting melakukan update atau gunakan paket khusus yang disiapkan untuk versi PHP dan dependency hosting tersebut.

Untuk instalasi pertama kali, lihat [Panduan Instalasi](INSTALASI.md).
