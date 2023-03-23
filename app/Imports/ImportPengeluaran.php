<?php

namespace App\Imports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPengeluaran implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pengeluaran([
            'tanggal' => $row[0],
            'nominal' => $row[1],
            'jenis' => $row[2],
            'penerima' => $row[3],
            'akun' => $row[4],
            'keterangan' => $row[5]
        ]);
    }
}
