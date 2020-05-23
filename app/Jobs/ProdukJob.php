<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Imports\ProdukImport;
use Illuminate\Support\Str;
use App\Produk;
use File;

class ProdukJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $kategori;
    protected $filename;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($kategori, $filename)
    {
        $this->kategori = $kategori;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $files = (new ProdukImport)->toArray(storage_path('app/public/uploads/' . $this->filename));

        //KEMUDIAN LOOPING DATANYA
        foreach ($files[0] as $row) {
            $explodeURL = explode('/', $row[4]);
            $explodeExtension = explode('.', end($explodeURL));
            $filename = time() . Str::random(6) . '.' . end($explodeExtension);
          
            file_put_contents(storage_path('app/public/produk') . '/' . $filename, file_get_contents($row[4]));

            Produk::create([
                'nama'          => $row[0],
                'slug'          => $row[0],
                'merk_id'       => $row[1],
                'category_id'   => $this->kategori,
                'ukuran'        => $row[2],
                'warna_id'      => $row[3],
                'stok'          => $row[4],
                'desc'          => $row[5],
                'harga'         => $row[6],
                'berat'         => $row[7],
                'foto'          => $filename,
                'status'        => true
            ]);
            // }
        }
        //JIKA PROSESNYA SUDAH SELESAI MAKA FILE YANG ADA DISTORAGE AKAN DIHAPUS
        File::delete(storage_path('app/public/uploads/' . $this->filename));
    }
}
