<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $unggulan = Menu::whereIn('badge', ['Best Seller', 'New'])
                        ->where('tersedia', true)
                        ->limit(4)
                        ->get();

        if ($unggulan->count() < 4) {
            $ids  = $unggulan->pluck('id');
            $sisa = Menu::where('tersedia', true)
                        ->whereNotIn('id', $ids)
                        ->limit(4 - $unggulan->count())
                        ->get();
            $unggulan = $unggulan->concat($sisa);
        }

        return view('welcome', compact('unggulan'));
    }
}