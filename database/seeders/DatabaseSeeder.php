<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AssetClassSeeder::class,
            AssetRegionSeeder::class,
            CashTypeSeeder::class,
            CurrencySeeder::class,
            CustodianSeeder::class,
        ]);
    }
}
