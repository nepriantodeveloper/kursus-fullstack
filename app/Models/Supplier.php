<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
   protected $primaryKey = 'id';

   public function pembelian(){
      return $this->hasMany('App\Models\Pembelian', 'id_supplier');
   }
}
