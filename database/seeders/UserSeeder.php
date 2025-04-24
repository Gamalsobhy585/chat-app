<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


  
        User::create([
            'id' => 1,
            'name' => 'test  user',
            'email' => 'user@test.com',
            'password' => Hash::make(123456789),

        ]);








    }



}
