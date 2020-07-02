<?php

use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggans')->insert([
            'nama' => 'Muhammad Rezzha',
            'email' => 'rezzhav@allbike.com',
            'password' => bcrypt('555666'),
            'telephone' => '087342521312',
            'alamat'   => 'Piyungan',
            'kecamatan_id' => '3311',
            'status' => '1',
        ]);
    }
}
