<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [   
                'id' => '1',
                'name' =>'test',
                'email' =>'test@test',
                //testtest
                'password' =>'$2y$10$r2fAmGZFsxmc9BfHittfWuxlRgeFSzd8IIP7wmbCocGsbe6jrW3N6',
                'created_at' => '2020-12-01 23:22:58',
                'updated_at' => '2020-12-01 23:22:58',
            ],
        ]);
    }
}
