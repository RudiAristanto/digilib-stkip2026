<div align="center">

# 📚 DIGILIB STKIP

### Digital Library Management System

**Sistem Perpustakaan Digital STKIP PGRI Ponorogo**

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-4-FDAE4B?style=for-the-badge&logo=filament&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-Framework-FB70A9?style=for-the-badge)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)

</div>

---

## 📖 Tentang DIGILIB STKIP

**DIGILIB STKIP** adalah aplikasi perpustakaan digital berbasis web yang dikembangkan untuk membantu pengelolaan karya ilmiah dan dokumen akademik di **STKIP PGRI Ponorogo**.

Aplikasi ini memungkinkan pengguna untuk menyimpan, mengelola, mencari, membaca, dan mengunduh berbagai koleksi digital seperti:

- 📘 Skripsi
- 📗 Tesis
- 📕 Disertasi
- 📰 Jurnal
- 📚 Buku
- 📄 Artikel Ilmiah
- 🔬 Laporan Penelitian
- 📑 Prosiding
- 📝 Karya Tulis Ilmiah lainnya

DIGILIB STKIP dibangun menggunakan **Laravel 12** dengan **Filament 4** sebagai Admin Panel.

---

# ✨ Fitur Utama

## 📊 Dashboard Admin

Dashboard digunakan untuk memberikan informasi dan statistik mengenai data yang terdapat di dalam aplikasi.

Beberapa informasi yang dapat ditampilkan antara lain:

- Jumlah dokumen
- Jumlah kategori
- Jumlah penulis
- Jumlah anggota
- Statistik koleksi digital
- Monitoring aktivitas aplikasi

---

## 📚 Manajemen Dokumen

Admin dapat melakukan pengelolaan dokumen digital melalui Admin Panel.

Fitur yang tersedia:

- ➕ Tambah dokumen
- ✏️ Edit dokumen
- 👁️ Lihat detail dokumen
- 🗑️ Hapus dokumen
- 📤 Upload file PDF
- 📝 Judul dokumen
- 📖 Abstrak
- 🏷️ Kata kunci
- 📅 Tahun terbit
- 👨‍🎓 Penulis
- 🗂️ Kategori
- 🎓 Program studi
- 🔐 Pengaturan akses dokumen
- 👁️ Statistik jumlah view
- 📥 Statistik jumlah download

---

## 👨‍🎓 Manajemen Penulis

DIGILIB menyediakan pengelolaan data penulis dokumen.

Data penulis meliputi:

- Nama penulis
- NIDN / NIM
- Email
- Foto
- Status penulis
- Dosen
- Mahasiswa
- Relasi dengan akun pengguna

---

## 🗂️ Manajemen Kategori

Admin dapat membuat dan mengelola kategori dokumen.

Contoh kategori:

- Skripsi
- Tesis
- Disertasi
- Jurnal
- Buku
- Artikel Ilmiah
- Laporan Penelitian
- Prosiding
- Karya Tulis Ilmiah

---

## 🎓 Manajemen Program Studi

Dokumen dapat dikelompokkan berdasarkan program studi.

Fitur:

- Tambah program studi
- Edit program studi
- Hapus program studi
- Relasi program studi dengan dokumen
- Filter dokumen berdasarkan program studi

---

## 👥 Manajemen Pengguna

Sistem memiliki pengelolaan akun pengguna dengan pembagian hak akses.

### 👑 Admin

Admin memiliki akses untuk:

- Mengakses Dashboard Admin
- Mengelola kategori
- Mengelola penulis
- Mengelola program studi
- Mengelola anggota
- Mengelola seluruh dokumen
- Mengelola file PDF
- Melihat statistik aplikasi
- Monitoring aktivitas sistem

### 👤 User / Mahasiswa

User atau mahasiswa dapat:

- Login ke aplikasi
- Melihat koleksi digital
- Mencari dokumen
- Melihat detail dokumen
- Mengunduh dokumen sesuai hak akses
- Mengelola dokumen milik sendiri

---

## 🔍 Pencarian Dokumen

Pengguna dapat mencari koleksi digital berdasarkan informasi dokumen seperti:

- Judul
- Penulis
- Kategori
- Program studi
- Tahun terbit
- Kata kunci

---

## 📥 Download Dokumen

Sistem mendukung pengunduhan dokumen digital dengan pencatatan aktivitas download.

Fitur meliputi:

- Download file PDF
- Riwayat download
- Jumlah download
- Statistik dokumen populer

---

## 👁️ Statistik Dokumen

Setiap dokumen dapat memiliki statistik:

- Jumlah view
- Jumlah download

Data tersebut dapat digunakan untuk mengetahui dokumen yang paling banyak dilihat atau diunduh.

---

# 🛠️ Tech Stack

| Technology | Keterangan |
|---|---|
| **Laravel 12** | Backend Framework |
| **PHP 8.2+** | Programming Language |
| **Filament 4** | Admin Panel |
| **Livewire** | Dynamic UI |
| **MySQL** | Database |
| **Tailwind CSS** | Frontend Styling |
| **Spatie Laravel Permission** | Role & Permission |
| **Laravel Storage** | File & PDF Storage |
| **Composer** | PHP Dependency Manager |
| **NPM** | Frontend Dependency Manager |
| **Git & GitHub** | Version Control |

---

# 🚀 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan **DIGILIB STKIP** pada komputer lokal.

---

## 1️⃣ Persyaratan Sistem

Pastikan komputer sudah memiliki:

```text
PHP >= 8.2
Composer >= 2.x
MySQL >= 8.x
Node.js >= 18.x
NPM
Git
```

Untuk pengguna Windows, direkomendasikan menggunakan:

```text
Laragon
```

---

## 2️⃣ Clone Repository

Clone repository DIGILIB STKIP:

```bash
git clone https://github.com/RudiAristanto/digilibstkip.git
```

Kemudian masuk ke folder project:

```bash
cd digilibstkip
```

---

## 3️⃣ Install Dependency PHP

Jalankan:

```bash
composer install
```

Tunggu sampai seluruh dependency Laravel selesai di-install.

---

## 4️⃣ Install Dependency Frontend

Jalankan:

```bash
npm install
```

Setelah selesai, build asset frontend:

```bash
npm run build
```

Untuk mode development dapat menggunakan:

```bash
npm run dev
```

---

## 5️⃣ Buat File `.env`

Copy file:

```text
.env.example
```

menjadi:

```text
.env
```

### Windows

```bash
copy .env.example .env
```

### Linux / macOS

```bash
cp .env.example .env
```

---

## 6️⃣ Generate Application Key

Jalankan:

```bash
php artisan key:generate
```

Jika berhasil akan muncul:

```text
Application key set successfully.
```

---

## 7️⃣ Buat Database

Buat database MySQL baru.

Contoh:

```text
db_stkip2026
```

Jika menggunakan Laragon, database dapat dibuat melalui:

```text
Menu Laragon
→ MySQL
→ phpMyAdmin
```

atau melalui aplikasi database manager seperti HeidiSQL.

---

## 8️⃣ Konfigurasi Database

Buka file:

```text
.env
```

Kemudian sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_stkip2026
DB_USERNAME=root
DB_PASSWORD=
```

> Sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` dengan konfigurasi MySQL masing-masing.

---

## 9️⃣ Jalankan Migration

Untuk membuat seluruh tabel database:

```bash
php artisan migrate
```

Jika project menggunakan seeder, jalankan:

```bash
php artisan db:seed
```

Atau migration dan seeder sekaligus:

```bash
php artisan migrate --seed
```

---

## 🔟 Buat Storage Link

DIGILIB menggunakan Laravel Storage untuk file seperti PDF dan foto.

Jalankan:

```bash
php artisan storage:link
```

Perintah tersebut akan membuat link:

```text
public/storage
        ↓
storage/app/public
```

---

## 1️⃣1️⃣ Bersihkan Cache

Jalankan:

```bash
php artisan optimize:clear
```

Perintah tersebut akan membersihkan:

- Application cache
- Configuration cache
- Route cache
- View cache

---

## 1️⃣2️⃣ Jalankan Aplikasi

Jalankan development server:

```bash
php artisan serve
```

Kemudian buka browser:

```text
http://127.0.0.1:8000
```

---

# 🖥️ Instalasi Menggunakan Laragon

Untuk pengguna **Laragon**, repository dapat ditempatkan di:

```text
C:\laragon\www\
```

Contoh:

```text
C:\laragon\www\digilib-stkip
```

Kemudian jalankan:

```bash
composer install
```

```bash
npm install
```

```bash
copy .env.example .env
```

```bash
php artisan key:generate
```

Konfigurasi database pada `.env`, kemudian:

```bash
php artisan migrate --seed
```

```bash
php artisan storage:link
```

```bash
php artisan optimize:clear
```

Kemudian restart Laragon.

Aplikasi dapat diakses melalui:

```text
http://digilib-stkip.test
```

> Nama domain lokal dapat berbeda tergantung nama folder project dan konfigurasi Laragon.

---

# ⚡ Quick Installation

Untuk yang sudah terbiasa menggunakan Laravel:

```bash
git clone https://github.com/RudiAristanto/digilibstkip.git

cd digilibstkip

composer install

npm install

copy .env.example .env

php artisan key:generate
```

Konfigurasikan database pada `.env`, kemudian:

```bash
php artisan migrate --seed

php artisan storage:link

php artisan optimize:clear

npm run build

php artisan serve
```

---

# 📁 Penyimpanan File

File publik seperti PDF dan foto disimpan menggunakan Laravel Storage.

Pastikan sudah menjalankan:

```bash
php artisan storage:link
```

Struktur penyimpanan:

```text
storage/
└── app/
    └── public/
        ├── documents/
        └── authors/
```

File publik kemudian dapat diakses melalui:

```text
public/storage/
```

---

# 📂 Struktur Fitur Aplikasi

```text
DIGILIB STKIP
│
├── 📊 Dashboard
│
├── 📚 Documents
│   ├── Upload PDF
│   ├── Metadata Dokumen
│   ├── Penulis
│   ├── Kategori
│   ├── Program Studi
│   └── Hak Akses
│
├── 👨‍🎓 Authors
│   ├── Dosen
│   └── Mahasiswa
│
├── 🗂️ Categories
│
├── 🎓 Study Programs
│
├── 👥 Members / Users
│
├── 📥 Downloads
│   └── Riwayat Unduhan
│
└── 🌐 Public Website
    ├── Koleksi Terbaru
    ├── Dokumen Populer
    ├── Search
    └── Detail Dokumen
```

---

# 📸 Screenshots

## 🏠 Homepage

Tambahkan screenshot halaman utama DIGILIB di sini.

```markdown
![DIGILIB Homepage](docs/screenshots/homepage.png)
```

## 📊 Dashboard Admin

```markdown
![DIGILIB Dashboard](docs/screenshots/dashboard.png)
```

## 📚 Manajemen Dokumen

```markdown
![DIGILIB Documents](docs/screenshots/documents.png)
```

## 👨‍🎓 Manajemen Penulis

```markdown
![DIGILIB Authors](docs/screenshots/authors.png)
```

> Buat folder `docs/screenshots` pada repository untuk menyimpan screenshot aplikasi.

---

# 🔐 Security

## ⚠️ Jangan Upload `.env`

File `.env` berisi informasi sensitif seperti:

- Database username
- Database password
- Application key
- API key
- Token
- Credential production

Pastikan `.gitignore` memiliki:

```gitignore
.env
/vendor
/node_modules
```

Jangan pernah melakukan:

```bash
git add .env
```

---

# 🧹 Useful Commands

### Clear Cache

```bash
php artisan optimize:clear
```

### Run Migration

```bash
php artisan migrate
```

### Run Seeder

```bash
php artisan db:seed
```

### Migration + Seeder

```bash
php artisan migrate --seed
```

### Storage Link

```bash
php artisan storage:link
```

### Development Server

```bash
php artisan serve
```

### Frontend Development

```bash
npm run dev
```

### Frontend Production Build

```bash
npm run build
```

---

# 🔄 Update Project

Jika project sudah pernah di-install dan ingin mengambil update terbaru:

```bash
git pull origin main
```

Kemudian:

```bash
composer install
```

```bash
npm install
```

```bash
php artisan migrate
```

```bash
php artisan optimize:clear
```

```bash
npm run build
```

---

# 🐛 Troubleshooting

## Storage Tidak Bisa Diakses

Jalankan:

```bash
php artisan storage:link
```

Kemudian:

```bash
php artisan optimize:clear
```

---

## Perubahan `.env` Tidak Terbaca

Jalankan:

```bash
php artisan config:clear
```

atau:

```bash
php artisan optimize:clear
```

---

## Error Class / Dependency Tidak Ditemukan

Jalankan:

```bash
composer install
```

Kemudian:

```bash
composer dump-autoload
```

dan:

```bash
php artisan optimize:clear
```

---

## Tampilan CSS / JavaScript Tidak Muncul

Jalankan:

```bash
npm install
```

Kemudian:

```bash
npm run build
```

---

## Database Belum Memiliki Tabel

Pastikan konfigurasi `.env` benar, kemudian:

```bash
php artisan migrate
```

atau:

```bash
php artisan migrate --seed
```

---

# 🤝 Contribution

Kontribusi dan pengembangan DIGILIB STKIP dapat dilakukan melalui GitHub.

1. Fork repository
2. Buat branch baru

```bash
git checkout -b feature/nama-fitur
```

3. Commit perubahan

```bash
git commit -m "Add new feature"
```

4. Push branch

```bash
git push origin feature/nama-fitur
```

5. Buat **Pull Request**

---

# 👨‍💻 Developer

### Rudi Aristanto

**Full Stack Developer**

`Laravel` • `Filament` • `Livewire` • `MySQL`

### 🚀 Awantech

**Digital Solutions & Web Development**

---

# 📄 License

Project **DIGILIB STKIP** dikembangkan untuk mendukung pengelolaan perpustakaan digital dan karya ilmiah **STKIP PGRI Ponorogo**.

---

<div align="center">

# 📚 DIGILIB STKIP

### Digital Library Management System

**Built with Laravel ❤️ Filament**

⭐ Jika project ini bermanfaat, jangan lupa berikan Star.

</div>
