<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tags')->insert([
            ['tag_name' => 'グルメ'],
            ['tag_name' => 'ホテル'],
            ['tag_name' => '旅館'],
            ['tag_name' => '観光'],
            ['tag_name' => '交通'],
            ['tag_name' => 'お土産'],
            ['tag_name' => 'レジャー'],
            ['tag_name' => 'カフェ'],
        ]);
    }
}
