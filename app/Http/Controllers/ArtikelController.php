<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Yajra\DataTables\DataTables;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $data = Artikel::all();
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
        return view('cms.artikel.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
