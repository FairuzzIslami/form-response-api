# 📄 Form API – Laravel Backend

API ini dikembangkan menggunakan Laravel dan berfungsi sebagai backend untuk sistem pembuatan dan pengisian formulir. Cocok digunakan untuk aplikasi survey, kuisioner, atau form feedback secara online.

---

## 🚀 Fitur Utama

- ✅ Autentikasi pengguna (register & login)
- ✅ CRUD Formulir
- ✅ CRUD Pertanyaan
- ✅ Penyimpanan respons pengguna
- ✅ API berbasis token (Laravel Sanctum)

---

## ⚙️ Teknologi yang Digunakan

- Laravel 10+
- PHP 8+
- MySQL
- Sanctum (untuk autentikasi token)
- Composer

---

## 🧾 Prasyarat

Pastikan kamu sudah menginstall:
- PHP >= 8.x
- Composer
- MySQL (Database sudah tersedia)
- Node.js & NPM *(jika ada bagian frontend atau kebutuhan build assets)*

---

## 📥 Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/username/form-api.git
cd form-api

# 2. Install dependensi
composer install

# 3. Copy konfigurasi lingkungan
cp .env.example .env
