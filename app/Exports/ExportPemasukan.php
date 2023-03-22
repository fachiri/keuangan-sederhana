<?php

namespace App\Exports;

use App\Models\Pemasukan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPemasukan implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pemasukan::select('tanggal', 'nominal', 'keterangan')->orderBy('created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nominal',
            'Keterangan',
        ];
    }
}
