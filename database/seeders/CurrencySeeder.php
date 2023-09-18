<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currency')->insert([
            [
                'id' => 1,
                'name' => '日本円',
                'code' => 'JPY',
            ],
            [
                'id' => 2,
                'name' => '米ドル',
                'code' => 'USD',
            ],
            [
                'id' => 3,
                'name' => 'ユーロ',
                'code' => 'EUR',
            ],
        ]);
    }
}
