<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asset_region')->insert([
            [
                'id' => 1,
                'name' => '日本',
            ],
            [
                'id' => 2,
                'name' => '米国',
            ],
            [
                'id' => 3,
                'name' => '欧州',
            ],
            [
                'id' => 4,
                'name' => 'その他先進国',
            ],
            [
                'id' => 5,
                'name' => '新興国',
            ],
        ]);
    }
}
