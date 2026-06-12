<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 10);
            $table->json('items');
            $table->unsignedBigInteger('total');
            $table->enum('metode', ['tunai', 'qris']);
            $table->enum('tipe', ['dine_in', 'take_away']);
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('uang')->default(0);
            $table->bigInteger('kembalian')->default(0);
            $table->enum('status', ['antrian', 'selesai'])->default('antrian');
            $table->boolean('is_urgent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};