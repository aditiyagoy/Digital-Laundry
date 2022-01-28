<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function selectSearch(Request $request)
    {
    	$karyawan = [];

        if($request->has('q')){
            $search = $request->q;
            $karyawan =Karyawan::all()
            		->where('id_karyawan', $search)
            		->first();
        }
        return response()->json($karyawan);
    }
}

