<?php

namespace App\Exports;

use App\Models\TransaksiKontraktor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiKontraktorExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

   public function __construct($created_at)
    {
        $this->created_at = $created_at;

    }

    public function query()
    {
        return TransaksiKontraktor::query()->whereDate('created_at', '>=', $this -> created_at);
    }

    public function headings(): array
    {
        return [
            '#', 'Nama Kontraktor','Perusahaan', 'Penanggung Jawab', 'Nama Barang', 'Tanggal Pinjam', 'Tanggal Kembali', 'Created At', 'Update At',
        ];
    }
}
