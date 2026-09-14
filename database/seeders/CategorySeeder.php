<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Skripsi',
                'icon' => 'heroicon-o-academic-cap',
                'sort_order' => 1,
            ],
            [
                'nama_kategori' => 'Tesis',
                'icon' => 'heroicon-o-book-open',
                'sort_order' => 2,
            ],
            [
                'nama_kategori' => 'Disertasi',
                'icon' => 'heroicon-o-document-text',
                'sort_order' => 3,
            ],
            [
                'nama_kategori' => 'Jurnal',
                'icon' => 'heroicon-o-newspaper',
                'sort_order' => 4,
            ],
            [
                'nama_kategori' => 'Buku',
                'icon' => 'heroicon-o-book-open',
                'sort_order' => 5,
            ],
            [
                'nama_kategori' => 'Artikel Ilmiah',
                'icon' => 'heroicon-o-document',
                'sort_order' => 6,
            ],
            [
                'nama_kategori' => 'Laporan Penelitian',
                'icon' => 'heroicon-o-clipboard-document',
                'sort_order' => 7,
            ],
            [
                'nama_kategori' => 'Prosiding',
                'icon' => 'heroicon-o-folder-open',
                'sort_order' => 8,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                [
                    'slug' => Str::slug($category['nama_kategori']),
                ],
                [
                    'nama_kategori' => $category['nama_kategori'],
                    'slug'          => Str::slug($category['nama_kategori']),
                    'deskripsi'     => $category['nama_kategori'],
                    'icon'          => $category['icon'],
                    'is_active'     => true,
                    'sort_order'    => $category['sort_order'],
                ]
            );
        }
    }
}