<?php

namespace App\Http\Controllers;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/barang');
    }

    // read data
    public function read()
    {
        $data = Barang::join('lokasis', 'barangs.id_lokasi', '=', 'lokasis.id_lokasi')->get(['barangs.*', 'lokasis.nama_lokasi']);
        return view('admin/readBarang')->with([
            'data' => $data,
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
        return view('admin/createBarang')->with([
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
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'id_lokasi' => 'required',
            'jml_barang' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status" => 400,
                "errors" => $validator->errors(),
            ]);
        }else{
            Barang::create([
                'id_barang' => $request->id_barang,
                'nama_barang' => $request->nama_barang,
                'id_lokasi' => $request->id_lokasi,
                'jml_barang' => $request->jml_barang,
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
        $data['item'] = Barang::where('barangs.id', $id)->join('lokasis', 'barangs.id_lokasi', '=', 'lokasis.id_lokasi')->get(['barangs.*', 'lokasis.nama_lokasi'])->first();
        // $data1 = Karyawan::join('lokasis', 'karyawans.id_lokasi', '=', 'lokasis.id_lokasi')->get(['karyawans.*', 'lokasis.*']);
        $data['data2'] = Lokasi::all();
        return view('admin/showBarang')->with($data);
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
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'id_lokasi' => 'required',
            'jml_barang' => 'required',
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
            $barang = Barang::find($id);
            $barang -> id_barang = $request->id_barang;
            $barang -> nama_barang = $request->nama_barang;
            $barang -> id_lokasi = $request->id_lokasi;
            $barang -> jml_barang = $request->jml_barang;
            $barang->save();
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
        $barang = Barang::find($id);
        $barang -> delete();
    }
}
