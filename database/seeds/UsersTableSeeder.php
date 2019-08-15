<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'email' =>'admin@gmail.com',
            'password' => Hash::make( config('messages.passDefaul') ),
            'role_id' => config('messages.roleAdmin'),
            'name' => 'admin',
        ]);
    }
}
