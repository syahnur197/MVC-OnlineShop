<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Default seeder: only what a real install needs. The demo catalogue is opt-in,
 * see App\Database\Seeds\DemoDataSeeder.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);
    }
}
