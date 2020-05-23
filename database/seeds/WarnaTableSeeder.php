<?php

use Illuminate\Database\Seeder;

class WarnaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO `warnas` (`id`, `nama`,`kodeWarna`,`created_at`, `updated_at`) VALUES
        (1, 'Hitam','000000' ,'2019-08-29 12:55:52', '2019-08-29 12:55:52'),
        (2, 'Putih','FFFFFF' ,'2019-08-29 12:55:52', '2019-08-29 12:55:52'),
        (3, 'Merah','FF0000' ,'2019-08-29 12:55:52', '2019-08-29 12:55:52'),
        (4, 'Biru','0000FF' ,'2019-08-29 12:55:52', '2019-08-29 12:55:52'),
        (5, 'Hijau','008000' ,'2019-08-29 12:55:52', '2019-08-29 12:55:52'),
        (6, 'Gold','FFD700' ,'2019-08-29 12:55:52', '2019-08-29 12:55:52'),
        (7, 'Pink','FFC0CB' ,'2019-08-29 12:55:52', '2019-08-29 12:55:52'),
        (8, 'Royal Blue','4169E1' ,'2019-08-29 12:55:52', '2019-08-29 12:55:52');");
    }
}
