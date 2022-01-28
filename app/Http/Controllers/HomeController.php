<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Karyawan;
use App\Models\Lokasi;
use App\Models\TransaksiKaryawan;
use App\Models\TransaksiKontraktor;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['karyawan'] = Karyawan::all();
        $data['barang'] = Barang::all();
        $data['lokasi'] = Lokasi::all();
        return view('home')->with($data);
    }
    public function selectSearch(Request $request)
    {
    	$karyawan = [];

        if($request->has('q')){
            $search = $request->q;
            $karyawan =Karyawan::select("*")
            		->where('nik_karyawan', $search)
            		->get();
        }
        return response()->json($karyawan);
    }
    public function getKaryawan($nik_karyawan)
    {
        $data = Karyawan::select("*")
        ->where('nik_karyawan', $nik_karyawan)
        ->first();
        return response() -> json([
            // 'nik' => $data -> nik,
            'nama_karyawan' => $data->nama_karyawan
        ]);
    }

    public function karyawanPinjam(){
        $data['karyawan'] = Karyawan::all();
        $data['barang'] = Barang::all();
        $data['lokasi'] = Lokasi::all();
        return view('karyawanPinjam')->with($data);
    }

    public function karyawanSearch(Request $request){
        $data = Karyawan::where('nik_karyawan', $request->nik)->first();
        if($data){return response()->json([
            'nama_karyawan' => $data->nama_karyawan,
            'id_lokasi' => $data->id_lokasi,
        ]);}else{
            return response()->json([
                'nama_karyawan' => "",
                'id_lokasi' => "",
            ]);
        }

    }
    public function barangSearch(Request $request){
        $barang = Barang::where('id_lokasi', $request->id_lokasi)->get();
        if($barang){
        return response()->json(
            $barang
        );}else{
            return response()->json(
                ''
            );
        }

    }

    // blum selesai
    public function storePinjam(Request $request){
        $a = json_decode($request->data);
        $b = Karyawan::where('nik_karyawan', $a[0]->nik)->first();
        // dd($b->status_peminjaman);
        if($b->status_peminjaman == 0){
            for($i = 0 ; $i<count($a); $i++){
            TransaksiKaryawan::create([
                'nik_karyawan' => $a[$i]->nik,
                'id_barang' => $a[$i]->id_barang,
                'tgl_pinjam' => Carbon::now(),
            ]);
             }
            DB::table('karyawans')
            ->where('nik_karyawan', $a[0]->nik)
            ->update([
                'status_peminjaman' => '1'
            ]);
            return response()->json([
                "status" => 200,
                "errors" => "Berhasil Melakukan Peminjaman",
            ]);
        }else{
            return response()->json([
                "status" => 240,
                "errors" => "Peminjaman Lain Belum Dikembalikan",
            ]);
        }

    }

    public function karyawanKembali(){
        $data['karyawan'] = Karyawan::all();
        $data['barang'] = Barang::all();
        $data['lokasi'] = Lokasi::all();
        return view('karyawanKembali')->with($data);
    }

    public function karyawanKembaliSearch(Request $request){
        $data = TransaksiKaryawan::join('karyawans', 'transaksi_karyawans.nik_karyawan', '=', 'karyawans.nik_karyawan')->join('barangs', 'transaksi_karyawans.id_barang', '=', 'barangs.id_barang')->where('transaksi_karyawans.nik_karyawan', $request->nik)->where('transaksi_karyawans.tgl_kembali', NULL)->orderByDesc('tgl_pinjam')->get(['transaksi_karyawans.*', 'karyawans.nama_karyawan', 'barangs.nama_barang']);
        if($data){
            return response()->json(
                $data
            );}else{
                return response()->json(
                    ''
                );
            }
    }

    public function updateKaryawanKembali(Request $request){
        $data = DB::table('transaksi_karyawans')
            ->where('nik_karyawan', $request->nik)->where('tgl_kembali', NULL)
            ->update([
                'tgl_kembali' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        $data2 = DB::table('karyawans')->where('nik_karyawan', $request->nik)->update(['status_peminjaman' => '0']);
        if($data && $data2){
            return response()->json([
                "status" => 200,
                "errors" => "Berhasil Melakukan Pengembalian",
            ]);}else{
                return response()->json([
                    "status" => 210,
                    "errors" => "Gagal Melakukan Peminjaman",
                ]);
            }
    }

    public function kontraktorPinjam(){
        $data['karyawan'] = Karyawan::all();
        $data['barang'] = Barang::all();
        $data['lokasi'] = Lokasi::all();
        return view('kontraktorPinjam')->with($data);
    }
    public function storePinjamKontraktor(Request $request){
        $a = json_decode($request->data);
        $b = TransaksiKontraktor::where('nama_kontraktor', $a[0]->nama_kontraktor)->where('tgl_kembali', NULL)->first();
        if($b != NULL){
            return response()->json([
                "status" => 210,
                "errors" => "Ada Peminjaman yang Belum Dikembalikan",
            ]);
        }else{
            for($i = 0 ; $i<count($a); $i++){
            TransaksiKontraktor::create([
                'nama_kontraktor' => $a[$i]->nama_kontraktor,
                'perusahaan' => $a[$i]->perusahaan,
                'penanggung_jawab' => $a[$i]->penanggung_jawab,
                'id_barang' => $a[$i]->id_barang,
                'qty' => $a[$i]->qty,
                'tgl_pinjam' => now(),
                // 'qty' => $a[$i]->qty,
            ]);
             }
            return response()->json([
                "status" => 200,
                "errors" => "Berhasil Melakukan Peminjaman",
            ]);
        }
    }
    public function kontraktorKembali(){
        $data['karyawan'] = Karyawan::all();
        $data['barang'] = Barang::all();
        $data['lokasi'] = Lokasi::all();
        return view('kontraktorKembali')->with($data);
    }

    public function kontraktorKembaliSearch(Request $request){
        $data = TransaksiKontraktor::join('barangs', 'transaksi_kontraktors.id_barang', '=', 'barangs.id_barang')->where('transaksi_kontraktors.nama_kontraktor', $request->nama_kontraktor)->where('transaksi_kontraktors.tgl_kembali', NULL)->orderByDesc('tgl_pinjam')->get(['transaksi_kontraktors.*', 'barangs.nama_barang']);
        if($data){
            return response()->json(
                $data
            );}else{
                return response()->json(
                    ''
                );
            }
    }

    public function updateKontraktorKembali(Request $request){
        $data = DB::table('transaksi_kontraktors')
            ->where('nama_kontraktor', $request->nama_kontraktor)
            ->update([
                'tgl_kembali' => Carbon::now(),
            ]);
        if($data){
            return response()->json([
                "status" => 200,
                "errors" => "Berhasil Melakukan Pengembalian",
            ]);}else{
                return response()->json([
                    "status" => 210,
                    "errors" => "Gagal Melakukan Peminjaman",
                ]);
            }
    }
}
