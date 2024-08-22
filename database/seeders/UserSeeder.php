<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create a default user
        User::create([
            'user_id'=>'123456789',
            'user_name' => 'admin',
            'user_phone' => '03009876567',
            'password' => '1234', // Ensure to hash the password
            'user_type' => 1,
            'user_detail'=>'Dummy user',
            'added_by'=>'haseeb'// You can set the user_type if you have this column
        ]);
    }
}
