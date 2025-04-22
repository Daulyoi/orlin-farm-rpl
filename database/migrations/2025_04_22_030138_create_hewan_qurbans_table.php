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
        Schema::create('hewan_qurbans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->decimal('bobot', 5, 2);
            $table->decimal('harga', 10, 2);
            $table->string('status');
            $table->string('kelamin');
            $table->text('deskripsi');
            $table->text('lokasi');
            $table->binary('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewan_qurbans');
    }
};
