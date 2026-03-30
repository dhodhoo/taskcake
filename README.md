# TaskCake 🧁
**Atur Hidupmu Sepemanis Kue!**

TaskCake adalah aplikasi manajemen tugas dan catatan pribadi yang dirancang dengan estetika *sweet & pastel* untuk membuat produktivitas harian Anda terasa lebih menyenangkan dan tidak membosankan.

---

## 🎨 Fitur Utama
- **Notes Gallery 📝**: Simpan ide-ide cemerlangmu dalam galeri catatan yang cantik. Dilengkapi dengan fitur pencarian dan paginasi.
- **Quick Schedules 🚀**: Atur misi harianmu agar tidak ada yang terlewat. Pencarian jadwal yang mudah dan urut berdasarkan waktu.
- **Cake Theme 🍰**: Antarmuka penuh warna pastel (pink, indigo, yellow) dengan desain modern berbasis *border* tebal dan bayangan dinamis.
- **Secure Auth 🔑**: Sistem pendaftaran dan masuk yang aman menggunakan Laravel Breeze.

## 🛠️ Tech Stack
- **Backend**: [Laravel 11+](https://laravel.com)
- **Frontend**: [Tailwind CSS](https://tailwindcss.com) (dengan desain kustom)
- **Interactivity**: [Alpine.js](https://alpinejs.dev)
- **Bundler**: [Vite](https://vitejs.dev)
- **Database**: [SQLite](https://www.sqlite.org) (Local-friendly)

## 🚀 Cara Menjalankan Project

1. **Clone Repository**
   ```bash
   git clone https://github.com/dhodhoo/taskcake.git
   cd taskcake
   ```

2. **Instalasi Dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan generate kunci aplikasi.
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

4. **Persiapan Database**
   Buat file database kosong dan jalankan migrasi.
   ```bash
   # Di Windows PowerShell:
   New-Item -Path "database/database.sqlite" -ItemType File
   
   # Jalankan Migrasi:
   php artisan migrate
   ```

5. **Jalankan Server**
   Buka dua terminal dan jalankan perintah berikut:
   ```bash
   # Terminal 1 (PHP Server)
   php artisan serve
   
   # Terminal 2 (Vite Server)
   npm run dev
   ```

Akses aplikasi di `http://localhost:8000` ✨

---

&copy; {{ date('Y') }} TaskCake. Built with 💖 by [@dhodho](http://github.com/dhodhoo)
