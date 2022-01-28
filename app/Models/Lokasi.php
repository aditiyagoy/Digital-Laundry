<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'lokasis';
    protected $fillable = [
        'id_lokasi',
        'nama_lokasi',
    ];


}
