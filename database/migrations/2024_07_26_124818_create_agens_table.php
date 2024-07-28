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
        Schema::create('agens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('kode_notelp')->nullable();
            $table->string('notelp')->unique();
            $table->string('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('gender')->nullable();
            $table->string('nama_rek')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('bank_rek')->nullable();
            $table->string('status_agen')->nullable();
            $table->string('sub_agen_id')->nullable(); //Backup id - ALTER TABLE `agens` ADD `sub_agen_id` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `status_agen`;
            $table->string('status_aktif')->nullable();
            $table->string('foto')->nullable();

            $table->foreignId('user_id')->constrained();
            $table->boolean('active')->default(1);
            $table->json('pengaturan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agens');
    }
};
