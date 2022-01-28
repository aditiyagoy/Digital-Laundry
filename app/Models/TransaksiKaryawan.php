<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiKaryawan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'transaksi_karyawans';
    protected $fillable = [
        'nik_karyawan',
        'id_barang',
    ];
}
