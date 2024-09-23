<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['user_id' => 'user1', 'name' => 'Munazir', 'email' => 'munazir@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 'user2', 'name' => 'Imran', 'email' => 'imran@example.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
