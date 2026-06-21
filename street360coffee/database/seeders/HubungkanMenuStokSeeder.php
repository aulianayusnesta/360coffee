<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\StokBahan;

class HubungkanMenuStokSeeder extends Seeder
{
    public function run(): void
    {
        // Mapping: nama menu => nama bahan (sesuai data di database)
        $mapping = [
            'nasi bakar'            => 'nasi bakar',
            'cappucino'             => 'bubuk kopi',
            'Americano'             => 'bubuk kopi',
            'chocholate'            => 'bubuk coklat',
            'vanilla creamy coklat' => 'bubuk coklat',
            'red velvet'            => 'bubuk red velvet',
        ];

        $berhasil = 0;
        $gagal    = [];

        foreach ($mapping as $namaMenu => $namaBahan) {
            $menu  = Menu::whereRaw('LOWER(nama) = ?', [strtolower($namaMenu)])->first();
            $bahan = StokBahan::whereRaw('LOWER(nama) = ?', [strtolower($namaBahan)])->first();

            if ($menu && $bahan) {
                $menu->update(['stok_bahan_id' => $bahan->id]);
                $berhasil++;
                $this->command->info("✅ {$menu->nama} → {$bahan->nama}");
            } else {
                $gagal[] = $namaMenu;
                if (!$menu)  $this->command->warn("⚠️  Menu tidak ditemukan: {$namaMenu}");
                if (!$bahan) $this->command->warn("⚠️  Bahan tidak ditemukan: {$namaBahan}");
            }
        }

        $this->command->newLine();
        $this->command->info("Selesai: {$berhasil} menu berhasil dihubungkan.");

        if (!empty($gagal)) {
            $this->command->warn('Gagal: ' . implode(', ', $gagal));
        }
    }
}