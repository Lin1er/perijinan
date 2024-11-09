<?php

namespace Database\Seeders;

use App\Models\Ijin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IjinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ijin::factory()->count(50)->create();
    }
}
