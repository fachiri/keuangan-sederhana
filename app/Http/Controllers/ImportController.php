<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPemasukan;
use App\Imports\ImportPengeluaran;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class ImportController extends Controller
{
    public function export_excel_pemasukan(Request $request) 
    {
        try {
            if (!isset($request->file)) {
                throw new Exception("File tidak ditemukan!");
            }
            if (explode('-', $request->file->getClientOriginalName())[7] != 'Pemasukan.xlsx') {
                throw new Exception("Format file tidak sesuai!");
            }
            Pemasukan::truncate();
            $data = Excel::toArray(new ImportPemasukan, $request->file)[0];
            array_shift($data);
            foreach ($data as $key) {
                Pemasukan::create([
                    'tanggal'     => $key[0],
                    'nominal'     => $key[1],
                    'keterangan'   => $key[2]
                ]);
            }
            return redirect('pemasukan')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return redirect('pemasukan')->with(['error' => $th->getMessage()]);
        }
    }

    public function export_excel_pengeluaran(Request $request) 
    {
        try {
            if (!isset($request->file)) {
                throw new Exception("File tidak ditemukan!");
            }
            if (explode('-', $request->file->getClientOriginalName())[7] != 'Pengeluaran.xlsx') {
                throw new Exception("Format file tidak sesuai!");
            }
            Pengeluaran::truncate();
            $data = Excel::toArray(new ImportPengeluaran, $request->file)[0];
            array_shift($data);
            foreach ($data as $key) {
                Pengeluaran::create([
                    'tanggal' => $key[0],
                    'nominal' => $key[1],
                    'jenis' => $key[2],
                    'penerima' => $key[3],
                    'akun' => $key[4],
                    'keterangan' => $key[5]
                ]);
            }
            return redirect('pengeluaran')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return redirect('pengeluaran')->with(['error' => $th->getMessage()]);
        }
    }
}
