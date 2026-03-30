# TaskCake 🧁
**Atur Hidupmu Sepemanis Kue!**

TaskCake adalah aplikasi manajemen tugas dan catatan pribadi yang dirancang dengan estetika *sweet & pastel* untuk membuat produktivitas harian Anda terasa lebih menyenangkan. Proyek ini telah berevolusi menjadi pengalaman web premium dengan animasi interaktif tingkat tinggi.

---

## 🎨 Fitur Unggulan & Animasi Ekstrem (Powered by GSAP)
- **Global Notes 🌍**: Berbagi catatan secara publik di Timeline dengan fitur *Like* dan *Comment* interaktif.
- **Interactive Particle Background ✨**: Latar belakang dinamis dengan taburan meses kue (*Sprinkles*) yang bereaksi lembut terhadap gerakan kursor Anda.
- **Custom Magnetic Cursor 🎯**: Kursor kustom dengan efek pengikut (*follower*) bergaya jeli yang merespons elemen interaktif.
- **Draggable Cards 🃏**: Kartu-kartu di Landing Page dapat ditarik, dilempar, dan melayang secara organik di layar.
- **Hero Reveal Animation 🎭**: Pembukaan teks yang dramatis dan ikon kue 🍰 yang bergoyang elastis saat halaman dimuat.
- **Optimal Performance ⚡**: Animasi dioptimalkan untuk kelancaran navigasi tanpa memberatkan CPU.

## 🛠️ Tech Stack & Support
- **Backend**: [Laravel 11+](https://laravel.com)
- **Database**: [MySQL](https://www.mysql.com) (Production Ready)
- **Frontend**: [Tailwind CSS](https://tailwindcss.com) 
- **Animations**: [GSAP (GreenSock Animation Platform)](https://greensock.com/gsap/)
- **Interactivity**: [Alpine.js](https://alpinejs.dev)
- **Bundler**: [Vite](https://vitejs.dev)
- **AI Pair Programmer**: [Gemini AI](https://gemini.google.com) (Google DeepMind) 🧑‍💻

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
   Salin file `.env.example` menjadi `.env` dan sesuaikan kredensial **MySQL** Anda.
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

4. **Persiapan Database**
   Pastikan server MySQL berjalan, buat database baru, lalu jalankan migrasi.
   ```bash
   php artisan migrate
   ```

5. **Jalankan Server**
   Buka dua terminal dan jalankan perintah berikut:
   ```bash
   # Terminal 1 (PHP Server)
   php artisan serve
   
   # Terminal 2 (Vite Server / HMR)
   npm run dev
   ```

Akses aplikasi di `http://localhost:8000` ✨

---

&copy; 2026 TaskCake. Built by [@dhodho](http://github.com/dhodhoo) & Gemini AI.
