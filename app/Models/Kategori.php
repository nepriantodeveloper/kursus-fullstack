<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = "kategori";
    protected $primaryKey = "id";
    public function produk() {
        return $this->hasMany('App\Models\Produk','id_kategori');
    }
}
