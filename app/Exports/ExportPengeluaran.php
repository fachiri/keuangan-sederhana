<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPengeluaran implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pengeluaran::select('tanggal', 'nominal', 'jenis', 'penerima', 'akun', 'keterangan')->orderBy('created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nominal',
            'Jenis',
            'Penerima',
            'Akun',
            'Keterangan'
        ];
    }
}
