<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        /***
         * admin default login info 
         * 
         */
        $user = new User();
        $user->name = 'abdur';
        $user->email = 'rahmansohel155@gmail.com';
        $user->password = Hash::make('password');
        $user->save();
        $user->assignRole('admin');
        /**
         * user default login info
         * 
         */
        $user = new User();
        $user->name = 'writer';
        $user->email = 'writer@gmail.com';
        $user->password = Hash::make('147147147');
        $user->save();
        $user->assignRole('writer');
    }
}