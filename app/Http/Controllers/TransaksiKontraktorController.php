<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiKontraktorExport;
use App\Models\TransaksiKontraktor;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use App\Models\Lokasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiKontraktorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/transaksiKontraktor');
    }

    // read data
    public function read()
    {
        $data = TransaksiKontraktor::join('barangs', 'transaksi_kontraktors.id_barang', '=', 'barangs.id_barang')->orderByDesc("tgl_pinjam")->get(['transaksi_kontraktors.*', 'barangs.nama_barang']);
        return view('admin/readTransaksiKontraktor')->with([
            'data' => $data,
        ]);
    }

    public function showReport()
    {
        return view('admin/showReportTransaksiKontraktor');
    }

    public function export($created_at)
    {
        // $transaction = TransaksiKaryawan::where('created_at', $created_at)->get();
        $a = Carbon::now();
        return Excel::download(new TransaksiKontraktorExport($created_at), "Transaksi Kontraktor ($a).xlsx");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Barang::all();
        return view('admin/createTransaksiKontraktor')->with([
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
            'nama_kontraktor' => 'required',
            'perusahaan' => 'required',
            'penanggung_jawab' => 'required',
            'id_barang' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status" => 400,
                "errors" => $validator->errors(),
            ]);
        }else{
            TransaksiKontraktor::create([
                'nama_kontraktor' => $request->nama_kontraktor,
                'perusahaan' => $request->perusahaan,
                'penanggung_jawab' => $request->penanggung_jawab,
                'id_barang' => $request->id_barang,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['item'] = TransaksiKontraktor::where('transaksi_kontraktors.id', $id)->join('barangs', 'transaksi_kontraktors.id_barang', '=', 'barangs.id_barang')->get(['transaksi_kontraktors.*', 'barangs.nama_barang'])->first();
        $data['data3'] = Barang::all();
        $data['data2'] = Lokasi::all();
        return view('admin/showTransaksiKontraktor')->with($data);
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
            'nama_kontraktor' => 'required',
            'perusahaan' => 'required',
            'penanggung_jawab' => 'required',
            'id_barang' => 'required',
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
            $transaksiKontraktor = TransaksiKontraktor::find($id);
            $transaksiKontraktor -> nama_kontraktor = $request->nama_kontraktor;
            $transaksiKontraktor -> perusahaan = $request->perusahaan;
            $transaksiKontraktor -> penanggung_jawab = $request->penanggung_jawab;
            $transaksiKontraktor -> id_barang = $request->id_barang;
            $transaksiKontraktor -> tgl_pinjam = $request->tgl_pinjam;
            $transaksiKontraktor -> tgl_kembali = $request->tgl_kembali;
            $transaksiKontraktor -> save();
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
        $transaksiKaryawan = TransaksiKontraktor::find($id);
        $transaksiKaryawan -> delete();
    }
}
