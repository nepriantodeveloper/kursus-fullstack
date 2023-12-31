<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukFrontController;
use Illuminate\Support\Facades\Auth;


/*
    Route Frontend
*/

Route::get('/', [ProdukFrontController::class,'index']);
Route::get('/produk/tocart/{id}', [ProdukFrontController::class,'tocart'])->name('produk.tocart');
Route::get('/produk/cart', [ProdukFrontController::class,'cart'])->name('produk.cart');
Route::get('/produk/checkout', [ProdukFrontController::class,'checkout'])->name('produk.checkout');
Route::get('/produk/account', [ProdukFrontController::class,'account'])->name('produk.account');
Route::get('/produk/listproduk', [ProdukFrontController::class,'listproduk'])->name('produk.listproduk');
Route::get('/produk/gridproduk', [ProdukFrontController::class,'gridproduk'])->name('produk.gridproduk');
Route::get('/produk/detail/{id}', [ProdukFrontController::class,'detail'])->name('produk.detail');
Route::get('/produk/home2', [ProdukFrontController::class,'home2'])->name('produk.home2');
Route::get('/produk/home3', [ProdukFrontController::class,'home3'])->name('produk.home3');
Route::get('/blog', [BlogController::class,'index'])->name('blog.index');
Route::get('/blog/detail', [BlogController::class,'detail'])->name('blog.detail');
Route::get('/member/login', [ProdukFrontController::class,'login'])->name('member.login');

/*
    Route Admin Cms
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('produk',ProdukController::class);
Route::resource('member',MemberController::class);
Route::resource('supplier',SupplierController::class);
Route::resource('artikel',ArtikelController::class);
Route::resource('kategori',KategoriController::class);
Route::post('kategori/hapus', [KategoriController::class, 'deleteSelected'])->name('deleteSelected');
Route::post('kategori/cetak', [KategoriController::class, 'print'])->name('print');
Route::post('kategori/export', [KategoriController::class, 'exportexcel'])->name('export');
Route::post('kategori/import', [KategoriController::class, 'importexcel'])->name('import');