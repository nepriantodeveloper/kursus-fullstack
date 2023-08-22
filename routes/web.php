<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('produk',ProdukController::class);
Route::resource('kategori',KategoriController::class);
Route::post('kategori/hapus', [KategoriController::class, 'deleteSelected'])->name('deleteSelected');
Route::post('kategori/cetak', [KategoriController::class, 'print'])->name('print');
Route::post('kategori/export', [KategoriController::class, 'exportexcel'])->name('export');
Route::post('kategori/import', [KategoriController::class, 'importexcel'])->name('import');