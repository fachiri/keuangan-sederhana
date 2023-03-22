<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::orderByDesc('tanggal')->get();
        $total = 0;
        foreach ($data as $key) {
            $total += $key->nominal;
        }
        return view('pengeluaran', [
            'pengeluaran' => $data,
            'total' => $total
        ]);
    }

    public function add(Request $request)
    {
        try {
            $nominal = str_replace(['.', 'Rp '], '', $request->nominal);
            Pengeluaran::create([
                'nominal'     => (int)$nominal,
                'tanggal'     => $request->tanggal,
                'jenis'     => $request->jenis,
                'penerima'     => $request->penerima,
                'keterangan'   => $request->keterangan,
                'akun'     => $request->akun
            ]);
            return redirect('pengeluaran')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return redirect('pengeluaran')->with(['error' => $th->getMessage()]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $nominal = str_replace(['.', 'Rp '], '', $request->nominal);
            Pengeluaran::where('id', $id)->update([
                'nominal'     => (int)$nominal,
                'tanggal'     => $request->tanggal,
                'jenis'     => $request->jenis,
                'penerima'     => $request->penerima,
                'keterangan'   => $request->keterangan,
                'akun'     => $request->akun
            ]);
            return redirect('pengeluaran')->with(['success' => 'Data Berhasil Diedit!']);
        } catch (\Throwable $th) {
            return redirect('pengeluaran')->with(['error' => $th->getMessage()]);
        }

    }

    public function delete($id)
    {
        try {
            Pengeluaran::where('id', $id)->delete();
            return redirect('pengeluaran')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Throwable $th) {
            return redirect('pengeluaran')->with(['error' => $th->getMessage()]);
        }
    }
}
