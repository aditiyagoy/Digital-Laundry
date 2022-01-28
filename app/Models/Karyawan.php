<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'karyawans';
    protected $fillable = [
        'nik_karyawan',
        'nama_karyawan',
        'id_lokasi',
        'ukuran_baju',
        'grup',
        'status_peminjaman',
    ];

}
