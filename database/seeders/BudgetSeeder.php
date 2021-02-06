<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('budgets')->insert([
            [
                'budget_name'=> '~1万円',
            ],
            [
                'budget_name'=> '1万円~3万円',
            ],
            [
                'budget_name'=> '3万円~5万円',
            ],
            [
                'budget_name'=> '5万円~10万円',
            ],
            [
                'budget_name'=>'10万円~20万円',
            ],
            [
                'budget_name'=>'20万円~',
            ],
        ]);
    }
}
