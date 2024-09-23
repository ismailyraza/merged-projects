<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('friends')->insert([
            [
                'user_id' => '9c69080b-d336-42c9-a431-dfe99660d2da', // Munazir
                'friend_id' => '9c60e3da-49fe-40a2-932a-5e9d198ed978', // Imran
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '9c69080b-d336-42c9-a431-dfe99660d2da', // Munazir
                'friend_id' => '7b60e3da-39fe-50a2-912a-6e9d198ed979', // Prachi
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
