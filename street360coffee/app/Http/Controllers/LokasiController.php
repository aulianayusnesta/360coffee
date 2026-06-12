<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $data = [
            // Alamat
            'alamat'           => 'Waru, Penajam Paser Utara - Kalimantan Timur',
            'alamat_detail'    => 'Depan Kelurahan Waru',

            // Jam operasional (format: "17.30", "23.00")
            'hari_operasional' => 'Senin - Minggu',
            'jam_buka'         => '17.30',
            'jam_tutup'        => '23.00',

            // Kontak
            'whatsapp'         => '+62 812 3456 7890',
            'instagram'        => '@360.coffee_',

            // Google Maps
            'maps_query'       => 'Waru, Penajam Paser Utara, Kalimantan Timur',
            'maps_url'         => 'https://maps.google.com/?q=Waru,+Penajam+Paser+Utara,+Kalimantan+Timur',
        ];

        return view('lokasi', $data);
    }
}