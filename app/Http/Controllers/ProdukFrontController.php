<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $produks = DB::select('select * from produk');
        $produk = Produk::all();
        $artikel = Artikel::all();
        return view('welcome',compact('produk','artikel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
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
        $id = $request->id;
        $value = $request->session()->get('key');
        echo $value;
        //return view('detail',compact('id'));
    }

    public function tocart(Request $request)  {
        //dd($request);
        echo $request->id;
        // $request->user()->id;
        $data = $request->session()->all();
        dd($data);
        // echo  $request->session()->get('key');
        
        $cart = Produk::find($request->id);
            // $cart = new Cart;
            // $cart->user_id = auth()->user()->id;
            // $cart->product_id = $product->id;
            // $cart->price = ($product->price-($product->price*$product->discount)/100);
            // $cart->quantity = 1;
            // $cart->amount=$cart->price*$cart->quantity;
            // if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            // $cart->save();
    }

    public function login(){
        return view('login');
    }
    public function loginSubmit(Request $request){
        $data= $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])){
            Session::put('user',$data['email']);
            return redirect()->route('home')->with('success', 'Successfully login!');
        }
        else{

            return redirect()->back()->with('error','Invalid email and password pleas try again!');
        }
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        return back()->flash('success','Logout successfully');
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            
            return redirect()->route('home')->flash('success','Successfully registered');
        }
        else{
            
            return back()->flash('error','Please try again!');;
        }
    }
    
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }
}
