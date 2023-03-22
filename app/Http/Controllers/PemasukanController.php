<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;

class PemasukanController extends Controller
{
    public function index()
    {
        $data = Pemasukan::orderByDesc('tanggal')->get();
        $total = 0;
        foreach ($data as $key) {
            $total += $key->nominal;
        }
        return view('pemasukan', [
            'pemasukan' => $data,
            'total' => $total
        ]);
    }

    public function add(Request $request)
    {
        try {
            $nominal = str_replace(['.', 'Rp '], '', $request->nominal);
            Pemasukan::create([
                'nominal'     => (int)$nominal,
                'tanggal'     => $request->tanggal,
                'keterangan'   => $request->keterangan
            ]);
            return redirect('pemasukan')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return redirect('pemasukan')->with(['error' => $th->getMessage()]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $nominal = str_replace(['.', 'Rp '], '', $request->nominal);
            Pemasukan::where('id', $id)->update([
                'nominal'     => (int)$nominal,
                'tanggal'     => $request->tanggal,
                'keterangan'   => $request->keterangan
            ]);
            return redirect('pemasukan')->with(['success' => 'Data Berhasil Diedit!']);
        } catch (\Throwable $th) {
            return redirect('pemasukan')->with(['error' => $th->getMessage()]);
        }

    }

    public function delete($id)
    {
        try {
            Pemasukan::where('id', $id)->delete();
            return redirect('pemasukan')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Throwable $th) {
            return redirect('pemasukan')->with(['error' => $th->getMessage()]);
        }
    }
}
