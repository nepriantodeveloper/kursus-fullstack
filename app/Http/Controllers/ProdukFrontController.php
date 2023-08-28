<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('welcome',compact('produk'));
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

    public function cart(Request $request) {
        return view('cart');
    }

    public function addcart(Request $request){

    }

    public function checkout(Request $request){
        return view('checkout');
    }

    public function account(Request $request){
        return view('account');
    }
    public function listproduk(Request $request){
        return view('list');
    }
    public function gridproduk(Request $request){
        return view('grid');
    }
    public function home2(Request $request){
        return view('account');
    }
    public function home3(Request $request){
        return view('account');
    }
    public function detail(Request $request){
        return view('detail');
    }
}
