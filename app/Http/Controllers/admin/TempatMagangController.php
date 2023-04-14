<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TempatMagangRequest;
use App\Models\TempatMagang;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class TempatMagangController extends Controller
{
    public function index(){
        return view('admin.tempat-magang');
    }

    public function datatables(){
        $data = TempatMagang::all();
        return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
    }

    public function detail($id){
        return TempatMagang::find($id);
    }

    public function store_update(TempatMagangRequest $request){

        TempatMagang::updateOrCreate(['id' => $request->id],$request->all() );

        return [
            'status' => 200, // SUCCESS
            'message' => 'Data berhasil disimpan'
        ];
    }

    public function delete($id){
        $delete = TempatMagang::find($id);

        if($delete <> ""){
            $delete->delete();
            return [
                'status' => 200,
                'message' => 'Data berhasil dihapus'
            ];
        }

        return [
            'status' => 300,
            'message' => 'Data tidak ditemukan'
        ];
    }
}
