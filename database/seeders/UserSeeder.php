<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'wesams',
            'email' => 'qadmin@addsmin.com',
            'password' => Hash::make('wesam'),
            'phone_number'=>'592wad355370ad'
        ]);
        DB::table('users')->insert([
            'name' => ' jemy same ',
            'email' => 'qmin@admin.com',
            'password' => Hash::make('wesam'),
            'phone_number'=>'9235asd5370da'
        ]);

    }
}
