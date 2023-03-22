<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\Pemasukan;

class HomeController extends Controller
{
    public function index()
    {
        $dataPemasukan = Pemasukan::get();
        $dataPengeluaran = Pengeluaran::get();
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        foreach ($dataPengeluaran as $key) {
            $totalPengeluaran += $key->nominal;
        }
        foreach ($dataPemasukan as $key) {
            $totalPemasukan += $key->nominal;
        }
        $totalKas = $totalPemasukan - $totalPengeluaran;
        return view('home', [
            'totalPengeluaran' => $totalPengeluaran,
            'totalPemasukan' => $totalPemasukan,
            'totalKas' => $totalKas
        ]);
    }
}
