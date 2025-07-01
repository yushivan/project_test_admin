
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

## 📦 Laravel + Filament Admin Panel

Proyek ini dibangun menggunakan Laravel 12 dan telah terintegrasi dengan [Filament Admin Panel](https://filamentphp.com) untuk manajemen backend.

---

## 🚀 Langkah Instalasi

### 1. Clone Project

```bash
git clone https://github.com/namauser/namaproject.git
cd namaproject
```

### 2. Install Dependency

```bash
composer install
npm install && npm run build
```

### 3. Salin File Environment

```bash
cp .env.example .env
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env` kamu dan sesuaikan dengan koneksi database lokal:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Migrasi Database

```bash
php artisan migrate
```

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di:  
[http://localhost:8000](http://localhost:8000)

---

## 🔐 Akses Halaman Admin (Filament)

Setelah server berjalan, buka halaman admin panel di:

📍 **URL:** [http://localhost:8000/admin](http://localhost:8000/admin)

🔑 **Login:**

- **Email:** `admin@admin.com`
- **Password:** `admin`

> ⚠️ Pastikan akun admin sudah ada di database. Jika belum, kamu bisa menambahkan dengan Tinker:

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@admin.com',
    'password' => bcrypt('admin'),
]);
```

---

## 🧪 Testing (Opsional)

Untuk menjalankan test unit:

```bash
php artisan test
```

---

## 📄 Lisensi

Proyek ini menggunakan lisensi open-source [MIT License](https://opensource.org/licenses/MIT).

---
