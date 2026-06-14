<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'kategori',
        'badge',
        'gambar',
        'tersedia',
        'stok_bahan_id',
    ];

    protected $casts = [
        'tersedia' => 'boolean',
    ];

    // Relasi ke StokBahan
    public function stokBahan()
    {
        return $this->belongsTo(StokBahan::class, 'stok_bahan_id');
    }

    // Relasi ke TransaksiItem
    public function transaksiItems()
    {
        return $this->hasMany(TransaksiItem::class, 'menu_id');
    }
}