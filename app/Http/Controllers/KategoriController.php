<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

//   $segment = ucwords($request->segment(1));
     //dd($segment);
      // return view('kategori.index', compact('segment'));
      //return view('kategori.index');

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
   
      if ($request->ajax()) {
         $data = Kategori::select('*');
         return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('checkbox', function ($row) {
                    $cek = "<input type='checkbox' name='id[]' value='".$row->id."'>";
                    return $cek;
                  })
                 ->addColumn('action', function($row){
                  $btn = '<div class="btn-group">
                  <a onclick="editForm('.$row->id.')" 
                  class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                  <a onclick="deleteData('.$row->id.')" 
                  class=" btn btn-danger btn-sm"><i class="fa fa-trash">
                  </i></a></div>';
               return $btn;
                 })
                 ->rawColumns(['checkbox','action'])
                    ->make(true);
     }
   
   
       return view('cms.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $kategori = new Kategori;
       $kategori->nama_kategori = $request['nama'];
       $kategori->save();
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
   {
     $kategori = Kategori::find($id);
     echo json_encode($kategori);
   }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
   {
      $kategori = Kategori::find($id);
      $kategori->nama_kategori = $request['nama'];
      $kategori->update();
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
   {
      $kategori = Kategori::find($id);
      $kategori->delete();
   }

   public function deleteSelected(Request $request)
    {
        foreach($request['id'] as $id){
            $produk = Kategori::find($id);
            $produk->delete();
        }
    }

   public function print(Request $request)
   {
       $datakategori = array();
       foreach($request['id'] as $id){
           $kategori = Kategori::find($id);
           $datakategori[] = $kategori;
       }
       $no = 1;
       $pdf = Pdf::loadView('cms.kategori.cetak', compact('datakategori', 'no'));
       $pdf->setPaper('a4', 'potrait');      
       return $pdf->stream();
   }

   public function exportexcel(){
        $kategori = Kategori::all();
        return Excel::create('datakategori',function($excel) use ($kategori){
            $excel->formArray($kategori);
        })->download('xls');
   }

   public function importtexcel(Request $request){
    if ($request->hasFile('file')) {
       $path = $request->file('file')->getRealPath();
       $data = Excel::load($path,function($reader){})->get();
       if (!empty($data) && $data->count()) {
            foreach ($data as $key => $val) {
                $kategori = new Kategori;
                $kategori->nama_kategori = $val->nama_kategori;
                $kategori->save();
            }
       }
    }
    return back();
   }
}
