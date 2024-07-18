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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid'); // session id ipaymu
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('id_ipaymu');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('fee', 8, 2); // biaya transaksi
            $table->decimal('total', 8, 2);
            $table->timestamp('batas_bayar'); // expired payment
            $table->string('via'); // jenis pembayaran
            $table->string('channel'); // jenis tujuan pembayaraan
            $table->string('status_desc'); // UPDATE AFTER SUBMIT
            $table->string('status_pembayaran'); // UPDATE AFTER SUBMIT

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
