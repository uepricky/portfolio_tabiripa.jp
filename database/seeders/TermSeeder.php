<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('terms')->insert([
            [
                'term_name'=> '日帰り',
            ],
            [
                'term_name'=> '1泊2日',
            ],
            [
                'term_name'=> '2泊3日',
            ],
            [
                'term_name'=> '3泊4日',
            ],
            [
                'term_name'=> '5日間',
            ],
            [
                'term_name'=> '6日間',
            ],
            [
                'term_name'=> '7日間',
            ],
            [
                'term_name'=> '8日間',
            ],
            [
                'term_name'=> '9日間',
            ],
            [
                'term_name'=> '10日間~',
            ],
        ]);
    }
}
