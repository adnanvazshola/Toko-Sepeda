<?php

namespace App\Imports;

use Illuminate\Support\Collection;
//use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProdukImport implements WithStartRow, WithChunkReading
{
	use Importable;
    /**
    * @param Collection $collection
    */

    /*
    public function collection(Collection $collection)
    {
        //
    }
    */

    public function startRow(): int
    {
        return 2;
    }

    //KEMUDIAN KITA GUNAKAN chunkSize UNTUK MENGONTROL PENGGUNAAN MEMORY DENGAN MEMBATASI LOAD DATA DALAM SEKALI PROSES
    public function chunkSize(): int
    {
        return 100;
    }
}
