<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User',[
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'username' => 'admin',
            'address' => 'admin'
        ])->create();
    }
}
