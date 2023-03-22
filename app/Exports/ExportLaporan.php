<?php

namespace App\Exports;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Laporan
{
    public $tanggal;
    public $kas;
    public $pemasukan;
    public $pengeluaran;
    public $jenis;
    public $penerima;
    public $akun;
    public $keterangan;
}

class ExportLaporan implements FromCollection, WithHeadings
{
    public function collection()
    {
        $new_pemasukan = [];
        $new_pengeluaran = [];
        function recursive_change_key($arr, $set) {
            if (is_array($arr) && is_array($set)) {
                $newArr = array();
                foreach ($arr as $k => $v) {
                    $key = array_key_exists( $k, $set) ? $set[$k] : $k;
                    $newArr[$key] = is_array($v) ? recursive_change_key($v, $set) : $v;
                }
                return $newArr;
            }
            return $arr;    
        }
        $pengeluaran = Pengeluaran::get()->toArray();
        for ($i=0; $i < sizeof($pengeluaran); $i++) { 
            $new_pengeluaran[$i] = recursive_change_key($pengeluaran[$i], ['nominal' => 'pengeluaran']);
        }
        $pemasukan = Pemasukan::get()->toArray();
        for ($i=0; $i < sizeof($pemasukan); $i++) { 
            $new_pemasukan[$i] = recursive_change_key($pemasukan[$i], ['nominal' => 'pemasukan']);
        }
        $data = array_merge($new_pemasukan, $new_pengeluaran);
        usort($data, function($a, $b) { 
            return strtotime($a['tanggal']) - strtotime($b['tanggal']); 
        });
        $laporan = [];
        $kas = 0;
        for ($i=0; $i < sizeof($data); $i++) {
            $obj = new Laporan();
            $obj->tanggal = $data[$i]['tanggal'];
            if(isset($data[$i]['pemasukan'])) {
                $kas += $data[$i]['pemasukan'];
            }
            if(isset($data[$i]['pengeluaran'])) {
                $kas -= $data[$i]['pengeluaran'];
            }
            $obj->kas = $kas;
            $obj->pemasukan = isset($data[$i]['pemasukan']) ? $data[$i]['pemasukan'] : null;
            $obj->pengeluaran = isset($data[$i]['pengeluaran']) ? $data[$i]['pengeluaran'] : null;
            $obj->jenis = isset($data[$i]['jenis']) ? $data[$i]['jenis'] : null;
            $obj->penerima = isset($data[$i]['penerima']) ? $data[$i]['penerima'] : null;
            $obj->akun = isset($data[$i]['akun']) ? $data[$i]['akun'] : null;
            $obj->keterangan = $data[$i]['keterangan'];
            $laporan[$i] = $obj;
        }
        return collect($laporan);
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Kas',
            'Pemasukan',
            'Pengeluaran',
            'Jenis',
            'Penerima',
            'Akun',
            'Keterangan'
        ];
    }
}
