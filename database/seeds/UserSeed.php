<?php

use Illuminate\Database\Seeder;
use \App\User;
use \Illuminate\Support\Facades\Hash;


class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Administrator',
            'email'=>'admin@admin.com.br',
            'password'=>Hash::Make('12345678')
        ]);
    }
}
