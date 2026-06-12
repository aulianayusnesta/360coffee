<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBahan extends Model
{
    protected $table    = 'stok_bahan';
    protected $fillable = ['nama', 'stok_saat_ini', 'stok_maks', 'satuan'];
    protected $casts    = ['stok_saat_ini' => 'float', 'stok_maks' => 'float'];

    public function getPersen(): float
    {
        if ($this->stok_maks <= 0) return 0;
        return min(100, max(0, ($this->stok_saat_ini / $this->stok_maks) * 100));
    }

    public function getStatus(): string
    {
        $p = $this->getPersen();
        if ($p >= 50) return 'aman';
        if ($p >= 20) return 'hampir_habis';
        return 'kritis';
    }

    public function getBarClass(): string
    {
        $p = $this->getPersen();
        if ($p >= 50) return 'bar-aman';
        if ($p >= 20) return 'bar-hampir';
        return 'bar-kritis';
    }
}