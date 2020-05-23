<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Adnan Vazshola',
            'email' => 'adnanvazshola@allbike.com',
            'password' => bcrypt('alvi1231231234')
        ]);
    }
}
