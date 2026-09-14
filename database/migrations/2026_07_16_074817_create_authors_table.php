<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penulis');
            $table->string('nim_nidn')->nullable();
            $table->string('email')->nullable();
            $table->enum('status',[
                'Mahasiswa',
                'Dosen'
            ]);
            $table->index('nama_penulis');
            $table->index('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
