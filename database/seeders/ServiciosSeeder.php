<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;
use App\Traits\SkuGenerator;

class ServiciosSeeder extends Seeder
{
    use SkuGenerator;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Servicio::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Servicio::factory()->create([
            'sku' => $this->generateUniqueSku(),
            'nombre' => 'Formateo de computadores',
            'precio' => 25
        ]);

        Servicio::factory()->create([
            'sku' => $this->generateUniqueSku(),
            'nombre' => 'Mantenimiento',
            'precio' => 30
        ]);

        Servicio::factory()->create([
            'sku' => $this->generateUniqueSku(),
            'nombre' => 'Hora de soporte en software',
            'precio' => 50
        ]);
    }
}
