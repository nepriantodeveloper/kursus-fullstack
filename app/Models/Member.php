<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'member';
	protected $primaryKey = 'id';

	public function penjualan(){
      return $this->hasMany('App\Models\Penjualan', 'id_supplier');
    }
}
