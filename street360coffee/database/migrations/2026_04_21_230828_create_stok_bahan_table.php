<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Buat tabel stok_bahan
        Schema::create('stok_bahan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('stok_saat_ini', 10, 2)->default(0);
            $table->decimal('stok_maks', 10, 2)->default(10);
            $table->string('satuan')->default('kg');
            $table->timestamps();
        });

        // ✅ Tambah stok_bahan_id ke menus (tanpa ->after() karena tersedia belum ada)
        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId('stok_bahan_id')
                  ->nullable()
                  ->constrained('stok_bahan')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['stok_bahan_id']);
            $table->dropColumn('stok_bahan_id');
        });

        Schema::dropIfExists('stok_bahan');
    }
};