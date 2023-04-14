<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use Yajra\Datatables\Datatables;
use App\Models\Siswa;
use App\Models\TempatMagang;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    public function index(){
        $data['data'] = TempatMagang::all();
        return view('admin.siswa', $data);
    }

    public function datatables(){
        $data = Siswa::with('tempat_magang')->get();
        return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
    }

    public function detail($id){
        return Siswa::find($id);
    }

    public function store_update(SiswaRequest $request){

        if(substr($request->no_telp, 0, 2) != '08'){
            return [
                'status' => 300,
                'message' => 'Nomer harus dimulai dari 08xxx',
            ];
        }

        if(!empty($request->file('gambar'))){
            $file = $request->file('gambar');

            $place_image = 'berkas/foto-siswa/';
            $name_image =  time()."_".$file->getClientOriginalName();

            $file->move($place_image, $name_image);
            $database_file = $place_image . $name_image;

            $request->request->add(['foto' => $database_file]);
        }

        $request->request->remove('upload_image');
        Siswa::updateOrCreate(['id' => $request->id],$request->all() );

        return [
            'status' => 200, // SUCCESS
            'message' => 'Data berhasil diubah'
        ];

    }

    public function cetak_data_diri($id){
        $data['siswa'] = Siswa::where('id', $id)->first();

        $pdf = PDF::loadview('pdf.siswa',$data);
        $pdf->setPaper("A4","potrait");

        return [
            'status' => 200,
            'data' => [
                'base64' => 'data:application/pdf;base64,'.base64_encode($pdf->stream()),
                'filename' => 'Data Siswa' . $data['siswa']->nama ,
            ],
        ];
    }

    public function delete($id){
        $siswa = Siswa::where('id',$id)->first();
        $path = public_path() . '/' . $siswa['foto'];
        if(file_exists($path)) {
            unlink($path);
        }

        return [
            'status' => 200,
            'message' => 'Data berhasil didelete'
        ];
    }
}
