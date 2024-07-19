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
            $table->boolean('tampil'); // ditampilkan di halaman web
            $table->boolean('aktif'); // pemesanan
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
