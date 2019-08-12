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
            'name' => 'Alex',
            'email' => 'alex@gmail.com',
            'password' => bcrypt('22desetiembre')
        ]);

        User::create([
            'name' => 'Nicol',
            'email' => 'nicol@gmail.com',
            'password' => bcrypt('22desetiembre')
        ]);

        User::create([
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('22desetiembre')
        ]);
    }
}
