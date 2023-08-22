<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportKategori implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        return new Kategori([
            'nama_kategori'     => $collection[0],
        ]);
    }

    
}
