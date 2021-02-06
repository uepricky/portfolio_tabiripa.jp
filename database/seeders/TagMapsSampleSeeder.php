<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagMapsSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->insert([
            [
                'id' => '1',
                'post_id' => '1',
                'tag_id' => '1',
            ],
        ]);
    }
}
