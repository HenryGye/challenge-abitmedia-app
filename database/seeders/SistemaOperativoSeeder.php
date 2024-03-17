<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SistemaOperativo;

class SistemaOperativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        SistemaOperativo::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        SistemaOperativo::factory()
        ->count(2)
        ->sequence(
            ['nombre' => 'Windows'],
            ['nombre' => 'Mac'],
        )
        ->create();
    }
}
