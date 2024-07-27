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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->integer('harga_coret')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('komisi_agen')->nullable();
            $table->integer('komisi_sub_agen')->nullable();
            $table->string('gambar')->nullable();
            $table->string('link')->nullable();
            $table->boolean('tampil')->default(1); // ditampilkan di halaman web
            $table->boolean('aktif')->default(1); // pemesanan
            $table->json('data')->nullable();
            $table->timestamp('mulai_event')->nullable();
            $table->timestamp('akhir_event')->nullable();
            $table->timestamps();
        });
    }

    // INSERT INTO `kelas` (`id`, `nama`, `tampil`, `aktif`, `created_at`, `updated_at`) VALUES ('1', 'proit', '1', '1', '2024-07-18 21:13:15', '2024-07-18 21:13:15');

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
