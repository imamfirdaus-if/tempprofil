# Panduan Instalasi Template Web Profil

Panduan ini berlaku untuk Laravel 12 + Filament 4. Aplikasi harus dilayani dari folder `public/`, bukan dari root proyek. Untuk cPanel, jalur yang disarankan adalah unggah/ekstrak berkas melalui File Manager, lalu jalankan perintah Laravel melalui cPanel Terminal atau SSH.

Dokumentasi resmi: [Persyaratan deployment Laravel](https://laravel.com/docs/12.x/deployment), [cPanel MultiPHP Manager](https://docs.cpanel.net/cpanel/software/multiphp-manager-for-cpanel/), dan [Composer di cPanel](https://docs.cpanel.net/knowledge-base/web-services/how-to-set-up-php-composer/).

## Persyaratan

- PHP 8.2 atau lebih baru, dengan ekstensi `ctype`, `curl`, `dom`, `fileinfo`, `mbstring`, `openssl`, `pdo`, `pdo_mysql` (atau `pdo_sqlite`), `tokenizer`, dan `xml`.
- Composer 2.
- MySQL 8+/MariaDB yang didukung hosting (direkomendasikan untuk produksi), atau SQLite untuk instalasi kecil.
- HTTPS aktif dan Apache `mod_rewrite` bila memakai Apache/cPanel.
- Ruang tulis oleh akun aplikasi pada `storage/` dan `bootstrap/cache/`.
- NPM tidak diperlukan untuk instalasi normal: stylesheet publik sudah berada di `public/css/site.css`. NPM hanya diperlukan bila mengubah entry point Vite.

## A. Instalasi melalui terminal/SSH

### Opsional: mengambil source dari GitHub privat

Jika source template disimpan di GitHub privat, server dapat mengambilnya langsung. Siapkan Git, Composer, dan GitHub CLI (`gh`). Buat fine-grained personal access token yang hanya mengakses repository template dengan permission **Contents: Read**. Masukkan token secara interaktif (jangan menulis token pada command, URL clone, atau file yang masuk web root):

```bash
read -rsp "GitHub read-only token: " GH_TOKEN
printf '\n'
export GH_TOKEN
gh repo clone OWNER/REPO /www/wwwroot/mpi.uinsgd.ac.id
unset GH_TOKEN
```

Contoh repository template: `imamfirdaus-if/tempprofil`. Ganti identifier pada perintah bila repository dipindahkan. Target clone harus belum ada atau masih kosong; bila sudah berisi situs/data, jangan timpa—gunakan direktori aplikasi baru dan atur document root domain ke folder `public/` milik aplikasi tersebut. GitHub CLI mendukung clone repository privat dan token melalui environment; autentikasi web `gh auth login` juga tersedia jika lebih sesuai. [Panduan `gh repo clone`](https://cli.github.com/manual/gh_repo_clone), [unduh source dari GitHub Release](https://cli.github.com/manual/gh_release_download).

Token pada contoh hanya hidup di sesi shell tersebut dan dihapus setelah clone. Untuk CMS updater, token read-only yang diperlukan untuk mengambil release akan disimpan terpisah pada environment server dan tidak ditampilkan/dikelola lewat CMS. Hindari menyimpan token menggunakan opsi penyimpanan plaintext GitHub CLI pada akun bersama.

### 1. Siapkan domain dan database

Pastikan DNS domain mengarah ke hosting dan sertifikat SSL aktif. Buat database serta user MySQL melalui panel hosting, lalu berikan hak akses ke database tersebut.

Gunakan direktori aplikasi di luar web root bila panel mendukungnya, atau pastikan domain hanya melayani folder `public/`. Contoh direktori:

```text
/home/CPANEL_USER/apps/profil/
```

Pastikan file `artisan`, `composer.json`, folder `app/`, dan folder `public/` berada langsung di root aplikasi, bukan terbungkus folder ekstra hasil ekstraksi ZIP.

### 2. Buat dan atur `.env`

```bash
cd /home/CPANEL_USER/apps/profil
cp .env.example .env
```

Edit `.env` dan sesuaikan setidaknya:

```dotenv
APP_NAME="Web Profil Program Studi"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.ac.id
APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id
APP_FALLBACK_LOCALE=en
SESSION_SECURE_COOKIE=true

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=CPANEL_USER_namadb
DB_USERNAME=CPANEL_USER_userdb
DB_PASSWORD="PASSWORD_DATABASE"
```

Gunakan nama database/user lengkap yang diberikan cPanel (sering kali diberi prefix username akun). Jangan menggunakan contoh password di atas secara literal. Jangan mengunggah atau membagikan `.env`.

### 3. Pasang dependency PHP dan buat application key

Pastikan `php -v` menunjukkan versi PHP yang sama atau kompatibel dengan pilihan domain pada MultiPHP Manager. Kemudian:

```bash
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
php artisan key:generate
```

`key:generate` hanya untuk instalasi baru. Simpan `.env` dan `APP_KEY` dengan aman; jangan jalankan ulang saat update karena dapat membuat data terenkripsi dan sesi lama tidak dapat dibaca.

### 4. Migrasi, data awal, dan admin pertama

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan db:seed --class=UinNewsSamplesSeeder --force
php artisan make:filament-user
php artisan storage:link
```

Saat diminta, isi nama, email admin, dan password yang kuat. Jangan menggunakan akun demo lokal di server publik. `DatabaseSeeder` berisi pengaturan awal halaman/profil; `UinNewsSamplesSeeder` mengganti konten dummy yang tampil dengan 10 ringkasan berita/informasi UIN yang ditautkan ke sumbernya.

### 5. Arahkan web root dan atur hak akses

Untuk path contoh `/www/wwwroot/mpi.uinsgd.ac.id`, atur document root domain ke:

```text
/www/wwwroot/mpi.uinsgd.ac.id/public
```

Jangan arahkan document root ke `/www/wwwroot/mpi.uinsgd.ac.id`, karena folder root berisi `.env`, source code, dan file internal lainnya. Pastikan pemilik proses PHP dapat menulis ke `storage/` dan `bootstrap/cache/`. Pada server Linux yang ownership-nya sesuai:

```bash
chmod -R 775 storage bootstrap/cache
chmod 600 .env
```

Jangan gunakan `chmod 777`. Jika ownership cPanel berbeda, ubah ownership melalui panel/dukungan hosting alih-alih memperlebar permission.

### 6. Cache produksi dan verifikasi

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Periksa halaman publik, sitemap, robots, dan login CMS:

- `https://domain-anda.ac.id/`
- `https://domain-anda.ac.id/sitemap.xml`
- `https://domain-anda.ac.id/robots.txt`
- `https://domain-anda.ac.id/ptipdpanel/login`

Setelah login, lengkapi identitas situs, logo, kontak, SEO, dan konten melalui CMS.

## B. Instalasi melalui cPanel

### Pilihan yang direkomendasikan: File Manager + cPanel Terminal

1. Di cPanel **Domains**, buat domain/subdomain dan tentukan document root-nya. Jika memungkinkan, gunakan `/home/CPANEL_USER/apps/profil/public`.
2. Di **MultiPHP Manager**, pilih PHP 8.2+ untuk domain; aktifkan ekstensi PHP yang tercantum di Persyaratan.
3. Di **MySQL Database Wizard**, buat database dan user, lalu berikan semua privilege pada database baru.
4. Melalui **File Manager**, buat `/home/CPANEL_USER/apps/profil/`, unggah paket ZIP, lalu ekstrak sampai `artisan` berada tepat di folder tersebut.
5. Salin `.env.example` menjadi `.env`, lalu edit nilai `APP_URL`, database, locale, dan environment seperti pada bagian A.
6. Buka **Terminal** di cPanel (atau sambungkan SSH), masuk ke folder proyek, lalu jalankan langkah Composer, key, migrate, seed, admin, storage, dan cache pada bagian A.
7. Pastikan document root domain mengarah ke folder `public/`, kemudian uji URL publik dan `/ptipdpanel/login`.

Nama menu dan akses Terminal dapat berbeda sesuai versi/konfigurasi penyedia hosting. Jika Terminal/SSH tidak tersedia, minta penyedia hosting menjalankan Composer dan Artisan, atau siapkan paket instalasi khusus. Upload melalui File Manager saja belum cukup untuk membuat application key, memasang dependency, menjalankan migrasi, dan membuat akun admin.

### Jika document root tidak dapat diarahkan ke `public/`

Minta hosting mengubah web root terlebih dahulu jika memungkinkan. Sebagai fallback, simpan aplikasi **di luar** `public_html`, salin hanya isi folder `public/` ke document root cPanel, lalu sesuaikan tiga path di `index.php` agar menunjuk ke lokasi proyek yang sebenarnya: `storage/framework/maintenance.php`, `vendor/autoload.php`, dan `bootstrap/app.php`. Buat juga tautan `storage` dari document root publik ke `storage/app/public` proyek. Jangan menyalin `.env`, `app/`, `vendor/`, `database/`, atau seluruh root Laravel ke `public_html`.

Contoh ini perlu disesuaikan dengan username dan lokasi akun:

```php
$appDir = '/home/CPANEL_USER/apps/profil';

if (file_exists($maintenance = $appDir.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require $appDir.'/vendor/autoload.php';
$app = require_once $appDir.'/bootstrap/app.php';
```

Biarkan bagian akhir `index.php` yang menangani request tetap seperti paket Laravel. Pastikan aturan rewrite dari `public/.htaccess` ikut berada pada document root publik. Jangan membuat salinan kedua folder aplikasi di dalam `public_html`.

## Jika muncul HTTP 500

1. Lihat `storage/logs/laravel.log` melalui File Manager/Terminal.
2. Pastikan `APP_KEY` terisi, konfigurasi database benar, dan PHP domain memenuhi versi serta extension.
3. Pastikan `storage/` dan `bootstrap/cache/` writable oleh akun PHP.
4. Bersihkan cache dengan `php artisan optimize:clear`, lalu buat ulang cache produksi.
5. Biarkan `APP_DEBUG=false` pada server publik. Jangan menampilkan stack trace kepada pengunjung.

## Catatan upgrade

Untuk update fitur setelah instalasi, ikuti [Panduan Update Klien](UPDATE-KLIEN.md). Update kode tidak menjalankan migrasi database; karena itu update fitur harus tetap kompatibel dengan skema database klien.
