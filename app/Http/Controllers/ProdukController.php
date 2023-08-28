<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Produk::select('*');
            $data = Produk::leftJoin('kategori', 'kategori.id', '=', 'produk.id')
                ->orderBy('produk.id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($item) {
                    $cek = "<input type='checkbox' name='id[]' value='" . $item->id . "'>";
                    return $cek;
                })
                ->addColumn('nomor', function ($item) {
                    return $item->id;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">
                     <a onclick="editForm(' . $row->id . ')" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                     <a onclick="deleteData(' . $row->id . ')" class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
                    return $btn;
                })
                ->rawColumns(['checkbox', 'nomor', 'action'])
                ->make(true);
        }
        $kategori = Kategori::all();
        return view('cms.produk.index', compact('kategori'));
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

        $jml = Produk::where('kode_produk', '=', $request['kode'])->count();
        if ($jml < 1) {
            $produk = new Produk;
            $produk->kode_produk    = $request['kode'];
            $produk->nama_produk    = $request['nama'];
            $produk->id_kategori    = $request['kategori'];
            $produk->merk          = $request['merk'];
            $produk->harga_beli      = $request['harga_beli'];
            $produk->diskon       = $request['diskon'];
            $produk->harga_jual    = $request['harga_jual'];
            $produk->stok          = $request['stok'];
            $produk->satuan          = $request['satuan'];
            $foto = time() . '.jpg';
            Storage::put('images/produk/', $foto);
            $produk->gambar = $foto;
            $produk->save();
            echo json_encode(array('msg' => 'success'));
            // $request->foto->storeAs('images/produk', $foto);
            // $request->move(public_path('images/produk'), $foto);
            // $request->foto->storeAs('public/images/produk', $foto);

            // $foto = $request->file('foto')->store('public/images/produk');

        } else {
            echo json_encode(array('msg' => 'error'));
        }
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
        $produk = Produk::find($id);
        echo json_encode($produk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $produk = Produk::find($id);
        $produk->nama_produk    = $request['nama'];
        $produk->id_kategori    = $request['kategori'];
        $produk->merk          = $request['merk'];
        $produk->harga_beli      = $request['harga_beli'];
        $produk->diskon       = $request['diskon'];
        $produk->harga_jual    = $request['harga_jual'];
        $produk->stok          = $request['stok'];
        $produk->satuan          = $request['satuan'];
       // $foto = $request->file('foto')->store('public/images/produk');
        //$produk->gambar = $foto;
        $produk->update();
        echo json_encode(array('msg' => 'success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
    }
}
