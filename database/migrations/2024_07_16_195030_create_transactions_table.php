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
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('sistem_lama_id')->nullable();
            $table->string('id_ipaymu');
            $table->integer('subtotal')->default(0);
            $table->integer('fee')->default(0); // biaya transaksi
            $table->integer('total')->default(0);
            $table->timestamp('batas_bayar'); // expired payment
            $table->timestamp('berhasil_bayar')->nullable(); // expired payment
            $table->string('via'); // jenis pembayaran
            $table->string('channel'); // jenis tujuan pembayaraan
            $table->string('payment_number')->nullable();
            $table->string('payment_name')->nullable();
            $table->string('status_desc'); // UPDATE AFTER SUBMIT
            $table->string('status_pembayaran'); // UPDATE AFTER SUBMIT
            $table->text('qris_string')->nullable(); // jika qris
            $table->string('qris_nmid')->nullable(); // jika qris

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
