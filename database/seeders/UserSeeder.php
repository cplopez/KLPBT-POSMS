<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds. php artisan db:seed --class=UserSeeder
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Im Admin",
            'email' => 'im.admin@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 1,
            'status' => 1
        ]);

        DB::table('orders')->insert([
            'order_number' => 1
        ]);
    }
}
