<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/karyawan');
    }

    // read data
    public function read()
    {
        // $data = Karyawan::all();
        $data1 = Karyawan::join('lokasis', 'karyawans.id_lokasi', '=', 'lokasis.id_lokasi')->orderBy('nama_karyawan', 'asc')->get(['karyawans.*', 'lokasis.nama_lokasi']);
        return view('admin/readKaryawan')->with([
            'data1' => $data1,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Lokasi::all();
        return view('admin/createKaryawan')->with([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik_karyawan' => 'required',
            'nama_karyawan' => 'required',
            'id_lokasi' => 'required',
            'grup' => 'required',
            'ukuran' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status" => 400,
                "errors" => $validator->errors(),
            ]);
        }else{
            Karyawan::create([
                'nik_karyawan' => $request->nik_karyawan,
                'nama_karyawan' => $request->nama_karyawan,
                'id_lokasi' => $request->id_lokasi,
                'ukuran_baju' => $request->ukuran,
                'grup' => $request->grup,
                'status_peminjaman' => $request->status_peminjaman,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['item'] = Karyawan::where('karyawans.id', $id)->join('lokasis', 'karyawans.id_lokasi', '=', 'lokasis.id_lokasi')->get(['karyawans.*', 'lokasis.nama_lokasi'])->first();
        // $data1 = Karyawan::join('lokasis', 'karyawans.id_lokasi', '=', 'lokasis.id_lokasi')->get(['karyawans.*', 'lokasis.*']);
        $data['data2'] = Lokasi::all();
        return view('admin/showKaryawan')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik_karyawan' => 'required',
            'nama_karyawan' => 'required',
            'id_lokasi' => 'required',
            'ukuran' => 'required',
            'grup' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status" => 400,
                "errors" => $validator->errors(),
            ]);
        }else{
            // DB::table('lokasis')->where('id_lokasi', $id_lokasi)->update([
            // 'nama_lokasi' => $request->nama_lokasi,
            // 'updated_at' => now(),
            $karyawan = Karyawan::find($id);
            $karyawan -> nik_karyawan = $request->nik_karyawan;
            $karyawan -> nama_karyawan = $request->nama_karyawan;
            $karyawan -> id_lokasi = $request->id_lokasi;
            $karyawan -> ukuran_baju = $request->ukuran;
            $karyawan -> grup = $request->grup;
            $karyawan->save();
        // ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
    }
}
