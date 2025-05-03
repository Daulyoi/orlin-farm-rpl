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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('metode');
            $table->decimal('jumlah', 10, 2);
            $table->dateTime('tanggal');
            $table->string('bukti');
            $table->string('status'); # waiting, accepted, rejected
            $table->unsignedBigInteger('id_pemesanan');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->foreign('id_pemesanan')->references('id')->on('pemesanans')->onDelete('restrict');
            $table->foreign('id_admin')->references('id')->on('admins')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
