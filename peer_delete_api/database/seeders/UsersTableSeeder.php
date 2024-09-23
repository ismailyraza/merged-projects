<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['id' => '9c69080b-d336-42c9-a431-dfe99660d2da', 'name' => 'Munazir', 'email' => 'munazir@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '9c60e3da-49fe-40a2-932a-5e9d198ed978', 'name' => 'Imran', 'email' => 'imran@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '7b60e3da-39fe-50a2-912a-6e9d198ed979', 'name' => 'Prachi', 'email' => 'prachi@example.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
