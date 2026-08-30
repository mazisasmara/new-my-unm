<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KategoriSeeder::class,
            GroupSeeder::class,
            UserSeeder::class,
            LayananSeeder::class,
            ProdiSeeder::class,
            AnalyticsLogSeeder::class,
        ]);
    }
}
