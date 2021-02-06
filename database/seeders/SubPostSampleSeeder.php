<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubPostSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sub_posts')->insert([
            [
                'post_sub_id' => '2',
                'post_main_id' => '1',
                'post_order' => '1',
                'comment' => 'subコメント',
                'photo' => 'samplephoto.jpg',
            ],
        ]);
    }
}
