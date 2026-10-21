<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        if (Banner::count() === 0) {
            Banner::create([
                'badge' => 'DIGITAL REPOSITORY STKIP',
                'judul' => 'Temukan Ribuan',
                'judul_sorot' => 'Karya Ilmiah secara Digital',
                'deskripsi' => 'Akses mudah ke skripsi, jurnal, tugas akhir, dan publikasi penelitian sivitas akademika STKIP dalam satu platform terpadu.',
                'gambar' => 'images/hero-library.png',
                'tombol_teks' => 'Jelajahi Koleksi',
                'tombol_url' => '/documents',
                'urutan' => 1,
                'is_active' => true,
            ]);

            Banner::create([
                'badge' => 'PUSAT SUMBER BELAJAR & RISET',
                'judul' => 'Publikasi Riset & Skripsi',
                'judul_sorot' => 'Berkualitas dan Terverifikasi',
                'deskripsi' => 'Dukung kemajuan akademik dengan referensi terpercaya yang telah ditelaah dan diverifikasi oleh perpustakaan dan dosen pembimbing.',
                'gambar' => 'images/hero-library.png',
                'tombol_teks' => 'Lihat Kategori',
                'tombol_url' => '/categories',
                'urutan' => 2,
                'is_active' => true,
            ]);
        }
    }
}
