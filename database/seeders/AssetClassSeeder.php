<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asset_class')->insert([
            [
                'id' => 1,
                'name' => '現金',
            ],
            [
                'id' => 2,
                'name' => '株式',
            ],
            [
                'id' => 3,
                'name' => '債券',
            ],
            [
                'id' => 4,
                'name' => 'REIT',
            ],
        ]);
    }
}
