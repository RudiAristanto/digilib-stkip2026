<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::firstOrCreate([

            'nama_penulis'=>'Administrator'

        ],[

            'email'=>'admin@stkip.ac.id',

            'status'=>'Dosen'

        ]);
    }
}
