<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuPublikController extends Controller
{
    public function index()
    {
        $semuaMenu = Menu::orderBy('kategori')->orderBy('nama')->get();

        $menus = $semuaMenu->groupBy('kategori');

        $total = $semuaMenu->where('tersedia', true)->count();

        return view('menu-detail', compact('menus', 'total'));
    }
}