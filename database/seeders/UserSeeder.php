<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'backend1@multisyscorp.com',
            'password' =>  Hash::make('test123'),
            'remember_token' => "default",
            'created_at' => date('Y-m-d h:i:s')
        ]);
    }
}
