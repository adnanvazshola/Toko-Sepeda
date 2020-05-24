<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(KecamatanTableSeeder::class);
    	$this->call(KotaTableSeeder::class);
    	$this->call(ProvinsiTableSeeder::class);
        $this->call(WarnaTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
