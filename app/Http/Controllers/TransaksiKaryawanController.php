<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKaryawan;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use App\Models\Lokasi;
use App\Exports\TransaksiKaryawansExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;



class TransaksiKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/transaksiKaryawan');
    }

    // read data
    public function read()
    {
        $data = TransaksiKaryawan::join('karyawans', 'transaksi_karyawans.nik_karyawan', '=', 'karyawans.nik_karyawan')->join('barangs', 'transaksi_karyawans.id_barang', '=', 'barangs.id_barang')->orderByDesc("tgl_pinjam")->get(['transaksi_karyawans.*', 'karyawans.nama_karyawan', 'barangs.nama_barang']);
        return view('admin/readTransaksiKaryawan')->with([
            'data' => $data,
        ]);
    }

    public function export($created_at)
    {
        // $transaction = TransaksiKaryawan::where('created_at', $created_at)->get();
        return Excel::download(new TransaksiKaryawansExport($created_at), 'transaksi_karyawans.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Barang::all();
        $data1 = Karyawan::all();
        return view('admin/createTransaksiKaryawan')->with([
            'data' => $data, 'data1' => $data1,
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
            'id_barang' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status" => 400,
                "errors" => $validator->errors(),
            ]);
        }else{
            TransaksiKaryawan::create([
                'nik_karyawan' => $request->nik_karyawan,
                'id_barang' => $request->id_barang,
                'tgl_pinjam' => now(),
            ]);
        }
    }

    public function showReport()
    {
        return view('admin/showReportTransaksiKaryawan');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['item'] = TransaksiKaryawan::where('transaksi_karyawans.id', $id)->join('karyawans', 'transaksi_karyawans.nik_karyawan', '=', 'karyawans.nik_karyawan')->join('barangs', 'transaksi_karyawans.id_barang', '=', 'barangs.id_barang')->get(['transaksi_karyawans.*', 'karyawans.nama_karyawan', 'barangs.nama_barang'])->first();
        $data['data1'] = Karyawan::all();
        $data['data3'] = Barang::all();
        $data['data2'] = Lokasi::all();
        return view('admin/showTransaksiKaryawan')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik_karyawan' => 'required',
            'id_barang' => 'required',
            'tgl_pinjam' => 'required',
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
            $transaksiKaryawan = TransaksiKaryawan::find($id);
            $transaksiKaryawan -> nik_karyawan = $request->nik_karyawan;
            $transaksiKaryawan -> id_barang = $request->id_barang;
            $transaksiKaryawan->tgl_pinjam = $request->tgl_pinjam;
            $transaksiKaryawan->tgl_kembali = $request->tgl_kembali;
            $transaksiKaryawan->save();
        // ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksiKaryawan = TransaksiKaryawan::find($id);
        $transaksiKaryawan -> delete();
    }
}
