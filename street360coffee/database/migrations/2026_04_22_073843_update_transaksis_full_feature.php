<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksis', 'tipe')) {
                $table->string('tipe')->default('dine_in')->after('metode_bayar');
            }
            if (!Schema::hasColumn('transaksis', 'catatan')) {
                $table->text('catatan')->nullable()->after('tipe');
            }
            if (!Schema::hasColumn('transaksis', 'status')) {
                $table->string('status')->default('antrian')->after('catatan');
            }
            if (!Schema::hasColumn('transaksis', 'is_urgent')) {
                $table->boolean('is_urgent')->default(false)->after('status');
            }
            if (!Schema::hasColumn('transaksis', 'nomor')) {
                $table->string('nomor')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['tipe', 'catatan', 'status', 'is_urgent', 'nomor']);
        });
    }
};