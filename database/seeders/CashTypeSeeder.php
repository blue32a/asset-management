<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cash_type')->insert([
            [
                'id' => 1,
                'name' => '現金',
            ],
            [
                'id' => 2,
                'name' => '普通預金',
            ],
            [
                'id' => 3,
                'name' => '定期預金',
            ],
            [
                'id' => 4,
                'name' => 'MMF',
            ]
        ]);
    }
}
