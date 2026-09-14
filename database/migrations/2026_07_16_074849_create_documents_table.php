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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('category_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->foreignId('author_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('abstrak');
            $table->text('kata_kunci');
            $table->year('tahun_terbit');
            $table->string('file_pdf');
            $table->string('cover')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->unsignedInteger('total_pages')->nullable();
            $table->string('bahasa')->default('Indonesia');
            $table->unsignedBigInteger('jumlah_download')->default(0);
            $table->unsignedBigInteger('jumlah_view')->default(0);
            $table->enum('access_type',[
                'public',
                'private'
            ])->default('public');
            $table->enum('status',[
                'draft',
                'pending',
                'published',
                'rejected'
            ])->default('pending');
            
            $table->index('judul');
            $table->index('tahun_terbit');
            $table->index('status');
            $table->index('access_type');
            $table->index('category_id');
            $table->index('author_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
