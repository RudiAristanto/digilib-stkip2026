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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable()->default('DIGITAL REPOSITORY STKIP');
            $table->string('judul');
            $table->string('judul_sorot')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar');
            $table->string('tombol_teks')->nullable();
            $table->string('tombol_url')->nullable();
            $table->integer('urutan')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
