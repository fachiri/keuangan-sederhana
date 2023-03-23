<?php

namespace App\Imports;

use App\Models\Pemasukan;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPemasukan implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pemasukan([
           'tanggal' => $row[0],
           'nominal' => $row[1],
           'keterangan' => $row[2],
        ]);
    }
}
