# MyUNM

## Font

Proyek ini tidak mengambil font atau library JavaScript dari domain eksternal. Font antarmuka memakai font sans-serif sistem yang tersedia di perangkat pengguna/browser (`ui-sans-serif`, `system-ui`, dan fallback bawaan). Chart.js dan SortableJS dipaketkan secara lokal oleh Vite. Konfigurasi pengambilan font Bunny telah dihapus dari `vite.config.js`.

Tidak ada domain font yang perlu di-whitelist. Perubahan ini hanya mengganti sumber font; layout, warna, ukuran, dan gaya antarmuka lainnya tidak diubah.

## Deploy menggunakan berkas ZIP

Panduan ini ditujukan untuk server yang menerima arsip ZIP, bukan Git clone. Build aset dilakukan **di komputer lokal** agar server tidak perlu menjalankan `npm install` atau mengakses internet untuk mengunduh font.

### 1. Siapkan arsip di komputer lokal

Jalankan dari direktori proyek:

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

Perintah `npm run build` wajib sukses dan menghasilkan folder `public/build`. Folder ini berisi CSS dan JavaScript siap produksi. Walaupun diabaikan oleh Git, folder tersebut **harus disertakan** dalam ZIP deployment.

Buat ZIP tanpa `.env`, `node_modules`, log, maupun cache lokal. Contoh:

```bash
zip -r myunm-deploy.zip . \
  -x '.env' '.env.backup' '.env.production' 'node_modules/*' '.git/*' 'storage/logs/*' \
  'storage/framework/cache/*' 'storage/framework/sessions/*' \
  'storage/framework/views/*' '*.log'
```

Jika server tidak menyediakan Composer atau tidak mempunyai akses internet ke Packagist, jangan mengecualikan folder `vendor` dari ZIP. Jika Composer tersedia di server, `vendor` boleh tidak disertakan dan dibuat pada langkah berikutnya.

### 2. Ekstrak dan konfigurasi di server

1. Ekstrak `myunm-deploy.zip` ke direktori aplikasi, misalnya `/var/www/myunm`.
2. Pastikan document root domain mengarah ke `/var/www/myunm/public`, bukan ke direktori proyek utama.
3. Buat `.env` dari `.env.example`, lalu isi konfigurasi produksi, khususnya `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, serta koneksi database MySQL berikut. Ganti seluruh nilai yang memakai tanda kurung siku sesuai data dari penyedia server. Jangan mengunggah `.env` dari komputer lokal.

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=[host-mysql]
   DB_PORT=3306
   DB_DATABASE=[nama-database]
   DB_USERNAME=[username-database]
   DB_PASSWORD=[password-database]
   ```

   Atur pula kredensial akun awal berikut sebelum menjalankan seeder:

   ```dotenv
   SUPERADMIN_USERNAME=[username-superadmin]
   SUPERADMIN_EMAIL=[email-superadmin]
   SUPERADMIN_PASSWORD=[password-kuat-superadmin]
   ```
4. Bila folder `vendor` tidak disertakan, jalankan:

   ```bash
   composer install --no-dev --optimize-autoloader
   ```

5. Jalankan perintah Laravel berikut:

   ```bash
   php artisan key:generate --force
   php artisan migrate --force
   php artisan storage:link
   php artisan optimize
   ```

6. Beri hak tulis kepada user web server untuk direktori `storage` dan `bootstrap/cache`.

### Membuat akun superadmin saja

Untuk database yang sudah memiliki struktur tabel, jalankan:

```bash
php artisan app:seed-superadmin
```

Untuk database baru yang boleh dikosongkan seluruhnya, jalankan migrasi dan hanya buat akun superadmin:

```bash
php artisan migrate:fresh --seed --seeder=SuperAdminSeeder --force
```

`migrate:fresh` menghapus seluruh tabel terlebih dahulu. Jangan jalankan perintah tersebut pada database produksi yang sudah berisi data.

### 3. Verifikasi setelah deploy

- Buka halaman publik dan halaman login.
- Pastikan CSS dan JavaScript termuat dari `/build/assets/...` dan tidak ada permintaan ke `fonts.bunny.net`, `fonts.googleapis.com`, `fonts.gstatic.com`, `cdn.jsdelivr.net`, atau `cdnjs.cloudflare.com` pada Network tab browser.
- Jika aset tidak termuat, pastikan folder `public/build` ada di server dan document root benar-benar menunjuk ke `public`.

## Perintah pengembangan

```bash
composer run dev
composer test
./vendor/bin/pint
```
