<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportPemasukan;
use App\Exports\ExportPengeluaran;
use App\Exports\ExportLaporan;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export_excel_pemasukan() 
    {
        try {
            return Excel::download(new ExportPemasukan, date("d-m-Y-H-i-s").'-Laporan-Pemasukan.xlsx');
            return redirect('pemasukan')->with(['success' => 'File Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return redirect('pemasukan')->with(['error' => $th->getMessage()]);
        }
    }
    
    public function export_excel_pengeluaran() 
    {
        try {
            return Excel::download(new ExportPengeluaran, date("d-m-Y-H-i-s").'-Laporan-Pengeluaran.xlsx');
            return redirect('pengeluaran')->with(['success' => 'File Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return redirect('pengeluaran')->with(['error' => $th->getMessage()]);
        }
    }

    public function export_excel_laporan() 
    {
        try {
            return Excel::download(new ExportLaporan, date("d-m-Y-H-i-s").'-Laporan-Keuangan.xlsx');
            return redirect('laporan')->with(['success' => 'File Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return redirect('laporan')->with(['error' => $th->getMessage()]);
        }
    }
}
