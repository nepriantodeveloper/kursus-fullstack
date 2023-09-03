<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'produk_id',
        'order_id',
        'quantity',
        'amount',
        'price',
        'status'];
    
    // public function Produk(){
    //     return $this->hasOne('App\Models\Produk','id','Produk_id');
    // }
    // public static function getAllProdukFromCart(){
    //     return Cart::with('Produk')->where('user_id',auth()->user()->id)->get();
    // }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
