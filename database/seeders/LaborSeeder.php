<?php

namespace Database\Seeders;

use App\Models\Labor;
use Illuminate\Database\Seeder;

class LaborSeeder extends Seeder
{
    public function run(): void
    {
        Labor::factory(3)->create();
    }
}
