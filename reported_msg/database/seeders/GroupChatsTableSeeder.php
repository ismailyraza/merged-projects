<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupChatsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('group_chats')->insert([
            ['group_name' => 'Laravel Enthusiasts', 'created_by' => 1],
            ['group_name' => 'PHP Developers', 'created_by' => 2],
        ]);
    }
}
