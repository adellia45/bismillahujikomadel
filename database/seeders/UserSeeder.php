<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder{
    public function run(): void 
    {
        User::create([
            'name'=> 'Super Admin',
            'username'=> 'Admin',
            'password' => Hash::make('bismillah'),
            'role' => 'super_admin',  
    ]); 
    }
}
