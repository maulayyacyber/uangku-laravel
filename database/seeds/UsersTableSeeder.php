<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'full_name'  => 'Fika Ridaul Maulayya',
            'email'      => 'ridaulmaulayya@gmail.com',
            'username'   => 'admin',
            'password'   => bcrypt('admin'),
            'avatar'     => '898192462.png'
        ]);
    }
}
