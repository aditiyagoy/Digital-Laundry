<?php

namespace App\Exports;

use App\Models\TransaksiKaryawan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiKaryawansExport implements FromQuery, WithHeadings
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return TransaksiKaryawan::all();
    // }

    use Exportable;

    public function __construct($created_at)
    {
        $this->created_at = $created_at;

    }

    public function query()
    {
        return TransaksiKaryawan::query()->whereDate('created_at', '>=', $this -> created_at);
    }

    public function headings(): array
    {
        return [
            '#', 'NIK', 'Id Barang', 'Tanggal Pinjam', 'Tanggal Kembali', 'Created At', 'Update At',
        ];
    }
}
