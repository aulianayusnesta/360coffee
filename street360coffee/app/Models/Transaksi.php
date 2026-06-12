<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'nomor',
        'items',
        'total',
        'metode',
        'tipe',
        'catatan',
        'uang',
        'kembalian',
        'status',
        'is_urgent',
    ];

    protected $casts = [
        'items'     => 'array',
        'is_urgent' => 'boolean',
    ];

    public function orderItems()
    {
        return $this->hasMany(TransaksiItem::class);
    }

    public static function generateNomor(): string
    {
        $total = self::count();
        $next  = $total + 1;
        return str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    public function getNamaItems(): string
    {
        if (is_array($this->items)) {
            return collect($this->items)
                ->map(fn($i) => ($i['nama'] ?? '') . ' x' . ($i['qty'] ?? 1))
                ->join(', ');
        }
        return '-';
    }
}