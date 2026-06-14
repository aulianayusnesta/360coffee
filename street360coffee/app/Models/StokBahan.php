<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBahan extends Model
{
    protected $table = 'stok_bahan';

    protected $fillable = [
        'nama',
        'stok_saat_ini',
        'stok_maks',
        'satuan',
    ];

    // Relasi ke Menu
    public function menus()
    {
        return $this->hasMany(Menu::class, 'stok_bahan_id');
    }

    // Hitung persentase stok
    public function getPersen(): float
    {
        if ($this->stok_maks == 0) return 0;
        return ($this->stok_saat_ini / $this->stok_maks) * 100;
    }

    // Klasifikasi status
    public function getStatus(): string
    {
        $persen = $this->getPersen();
        if ($persen <= 20) return 'kritis';
        if ($persen <= 50) return 'hampir_habis';
        return 'aman';
    }

    // CSS class untuk progress bar
    public function getBarClass(): string
    {
        return match($this->getStatus()) {
            'kritis'       => 'bar-kritis',
            'hampir_habis' => 'bar-hampir',
            default        => 'bar-aman',
        };
    }
}