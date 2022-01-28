<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiKontraktor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'transaksi_kontraktors';
    protected $fillable = [
        'nama_kontraktor',
        'perusahaan',
        'penanggung_jawab',
        'id_barang',
    ];

}
