<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/fadil-efdika/aspiraX/actions"><img src="https://img.shields.io/github/actions/workflow/status/fadil-efdika/aspiraX/laravel.yml?branch=main" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Laravel Version"></a>
<a href="https://img.shields.io/badge/web3-enabled-blue" alt="Web3"></a>
<a href="https://img.shields.io/badge/license-MIT-green" alt="License"></a>
</p>

---

# 🚀 AspiraX

AspiraX adalah **platform sosial media berbasis Web3** yang terinspirasi dari Twitter, namun dengan pendekatan **decentralized login via Metamask**.  
Dengan AspiraX, identitas pengguna tetap aman karena tidak bergantung pada username/password tradisional.  

---

## ✨ Fitur Utama

- 🔑 **Login Web3 (Metamask)** → User masuk menggunakan wallet Metamask, menjaga privasi & identitas.  
- 🤖 **Filter AI Anti-Kata Kasar** → Postingan akan difilter otomatis agar tetap sehat & aman.  
- 🎮 **Gamifikasi** → Posting & komentar akan menambah poin. Semakin aktif, semakin "melek" terhadap isu-isu sosial, politik, dan lainnya.  
- 🧩 **Berbasis Laravel** → Framework modern yang kuat, elegan, dan mudah dikembangkan.  

---

## 🛠️ Teknologi yang Digunakan
- [Laravel](https://laravel.com/) (Backend utama)  
- [Metamask](https://metamask.io/) (Web3 Authentication)  
- [AI Toxic Filter](https://huggingface.co/) (Model NLP untuk filter kata kasar)  
- MySQL / PostgreSQL (Database)  
- TailwindCSS + Alpine.js (Frontend cepat & clean)  

---

## 📦 Cara Instalasi

Ikuti langkah berikut untuk menjalankan AspiraX di lokal:

### 1. Clone Repository
```bash
git clone https://github.com/fadil-efdika/aspiraX.git
cd aspiraX
```
### 2. Install Dependency
```bash
composer install
npm install && npm run dev
```

### 3. Konfigurasi Environment
Salin file .env.example menjadi .env:
```bash
cp .env.example .env
```

Lalu sesuaikan:

* Database (DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
* App Key:
```bash
php artisan key:generate
```

### 4. Migrasi & Seed Database
```bash
php artisan migrate --seed
```

### 4. Jalankan Server
```bash
php artisan serve
```
