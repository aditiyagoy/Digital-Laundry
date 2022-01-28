<?php

namespace App\Http\Controllers;


use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    public function lokasi()
    {
        return view('admin/area');
    }

    public function read()
    {
        $data = Lokasi::all();
        return view('admin/readArea')->with([
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        $data = DB::table('lokasis')->select('*')->where('id_lokasi', $request->search)->orWhere('nama_lokasi', $request->search)->paginate(10);
        return view('admin/readArea')->with([
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('admin/createArea');
    }
    /**
     * @param \Iluminate\Http\Request $request
     * @param \Iluminate\Http\Response
     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'id_lokasi' => 'required',
            'nama_lokasi' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status" => 400,
                "errors" => $validator->errors(),
            ]);
        }else{
            Lokasi::create([
                'id_lokasi' => $request->id_lokasi,
                'nama_lokasi' => $request->nama_lokasi,
            ]);
        }

    }

    public function show($id)
    {
        // $data = DB::table('lokasis')->select('*')->where('id_lokasi', $id_lokasi)->get();
        $data['item'] = Lokasi::where('id', $id)->get()->first();
        return view('admin/showArea')->with($data);
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'nama_lokasi' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status" => 400,
                "errors" => $validator->errors(),
            ]);
        }else{

            $lokasi = Lokasi::find($id);
            $lokasi -> nama_lokasi = $request->nama_lokasi;
            $lokasi->save();
        }

    }

    public function destroy($id)
    {
        // DB::table('lokasis')->where('id_lokasi', $id_lokasi)->delete();
        // return view('admin/area');
        $lokasi = Lokasi::find($id);
        $lokasi->delete();
    }

}
