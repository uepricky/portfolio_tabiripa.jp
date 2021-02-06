<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSampleSeeder extends Seeder
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
                'post_main_id'=>'1',
                'user_id'=>'1',
                'title'=>'タイトルテスト',
                'area'=>'東京',
                'impression'=>'感想テスト',
                'budget_id'=>'1',
                'photo'=>'samplephoto.jpg',
                'year'=>'2020',
                'month'=>'1',
                'term_id'=>'1',
            ],
        ]);
    }
}
