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

            // Jam operasional (format: "17.30", "01.00")
            'hari_operasional' => 'Senin - Minggu',
            'jam_buka'         => '17.30',
            'jam_tutup'        => '01.00',

            // Kontak
            'whatsapp'         => '+62 5787911107',
            'instagram'        => '@360.coffee_',

            // Google Maps
            'maps_query'       => 'Waru, Penajam Paser Utara, Kalimantan Timur',
            'maps_url'         => 'https://www.google.com/maps/place/360+Coffee/@-1.38825,116.61972,17z',
        ];

        return view('lokasi', $data);
    }
}