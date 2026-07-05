# Sistem Monitoring Penggunaan Dana Bantuan Studi Akhir Mahasiswa

Sistem Monitoring Penggunaan Dana Bantuan Studi Akhir Mahasiswa merupakan aplikasi berbasis web yang digunakan untuk memantau penggunaan dana bantuan studi mahasiswa di Kabupaten Mamberamo Tengah. Sistem ini mendukung proses pelaporan penggunaan dana, monitoring oleh petugas, serta penyajian laporan secara transparan dan akuntabel.

---

# Teknologi yang Digunakan

- Laravel 12
- PHP 8.2 atau lebih baru
- MySQL / MariaDB
- Tailwind CSS
- Alpine.js
- Chart.js
- Laravel Breeze
- Vite

---

# Persyaratan Sistem

Pastikan perangkat telah terinstal aplikasi berikut.

| Software | Versi |
|----------|--------|
| Visual Studio Code | Terbaru |
| PHP | 8.2.x |
| Composer | 2.8.x atau terbaru |
| Node.js | 22.x LTS |
| npm | 10.x atau terbaru |
| XAMPP | 8.2.x |
| Git | 2.45.x atau terbaru |

Untuk memastikan versi yang digunakan, jalankan perintah berikut:

```bash
php -v
```

```bash
composer -V
```

```bash
node -v
```

```bash
npm -v
```

```bash
git --version
```

---

# Cara Instalasi Project

## 1. Clone Repository

```bash
git clone https://github.com/USERNAME/monitoring-beasiswa.git
```

Masuk ke folder project.

```bash
cd monitoring-beasiswa
```

---

## 2. Install Dependency PHP

```bash
composer install
```

---

## 3. Install Dependency JavaScript

```bash
npm install
```

---

## 4. Salin File Environment

Windows

```bash
copy .env.example .env
```

Linux / MacOS

```bash
cp .env.example .env
```

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Buat Symbolic Link Storage

```bash
php artisan storage:link
```

---

## 7. Konfigurasi Database

Buka file

```
.env
```

Kemudian sesuaikan konfigurasi database.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=monitoring_beasiswa
DB_USERNAME=root
DB_PASSWORD=
```

---

## 8. Import Database

Buka phpMyAdmin melalui XAMPP.

Buat database baru.

```
monitoring_beasiswa
```

Kemudian import file database.

```
monitoring_beasiswa.sql
```

---

## 9. Jalankan Migration (Opsional)

Apabila tidak menggunakan file SQL.

```bash
php artisan migrate
```

---

## 10. Jalankan Seeder (Opsional)

```bash
php artisan db:seed
```

atau

```bash
php artisan migrate:fresh --seed
```

---

## 11. Build Asset

Mode Development

```bash
npm run dev
```

Mode Production

```bash
npm run build
```

---

## 12. Jalankan Server Laravel

```bash
php artisan serve
```

Akses aplikasi melalui browser.

```
http://127.0.0.1:8000
```

---

# Login Sistem

Gunakan akun yang tersedia pada database.

Contoh

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | password |
| Keuangan | keuangan@gmail.com | password |
| Mahasiswa | mahasiswa@gmail.com | password |
| Kepala | kepala@gmail.com | password |

---

# Struktur Role

- Admin
- Keuangan
- Mahasiswa
- Kepala

---

# Fitur Sistem

- Login Multi Role
- Dashboard
- Import Data Mahasiswa
- Manajemen Data Mahasiswa
- Manajemen Kategori Penggunaan Dana
- Input Penggunaan Dana
- Monitoring Penggunaan Dana
- Grafik Dashboard
- Laporan
- Profil Pengguna

---

# Developer

Sistem Monitoring Penggunaan Dana Bantuan Studi Akhir Mahasiswa

Kabupaten Mamberamo Tengah

Universitas Sains dan Teknologi Jayapura (USTJ)

Program Studi Teknik Informatika

---

# Lisensi

Project ini dibuat untuk kebutuhan penelitian dan pengembangan Sistem Monitoring Penggunaan Dana Bantuan Studi Akhir Mahasiswa Kabupaten Mamberamo Tengah.
