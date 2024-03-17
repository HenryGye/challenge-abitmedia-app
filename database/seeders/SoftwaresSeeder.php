<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Software;
use App\Models\Licencia;
use App\Traits\SkuGenerator;
use App\Traits\SerialGenerator;

class SoftwaresSeeder extends Seeder
{
    use SkuGenerator, SerialGenerator;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Software::truncate();
        Licencia::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Antivirus
        // Windows
        for ($i = 0; $i < 10; $i++) {
            $sku = $this->generateUniqueSku();
            $antivirusWin = Software::factory()->create([
                'sku' => $sku,
                'nombre' => 'Antivirus Windows - '.$sku,
                'precio' => 5,
                'so_id' => 1
            ]);
            Licencia::create([
                'serial' => strtoupper($this->generarSerialUnico()),
                'software_id' => $antivirusWin->id,
            ]);
        }
    
        // Mac
        for ($i = 0; $i < 10; $i++) {
            $sku = $this->generateUniqueSku();
            $antivirusMac = Software::factory()->create([
                'sku' => $sku,
                'nombre' => 'Antivirus Mac - '.$sku,
                'precio' => 7,
                'so_id' => 2
            ]);
            Licencia::create([
                'serial' => strtoupper($this->generarSerialUnico()),
                'software_id' => $antivirusMac->id,
            ]);
        }

        // Ofimatica
        // Windows
        for ($i = 0; $i < 20; $i++) {
            $sku = $this->generateUniqueSku();
            $ofimaticaWin = Software::factory()->create([
                'sku' => $sku,
                'nombre' => 'Ofimcatica Windows - '.$sku,
                'precio' => 10,
                'so_id' => 1
            ]);
            Licencia::create([
                'serial' => strtoupper($this->generarSerialUnico()),
                'software_id' => $ofimaticaWin->id,
            ]);
        }
    
        // Mac
        for ($i = 0; $i < 20; $i++) {
            $sku = $this->generateUniqueSku();
            $ofimaticaMac =  Software::factory()->create([
                'sku' => $sku,
                'nombre' => 'Ofimatica Mac - '.$sku,
                'precio' => 12,
                'so_id' => 2
            ]);
            Licencia::create([
                'serial' => strtoupper($this->generarSerialUnico()),
                'software_id' => $ofimaticaMac->id,
            ]);
        }

        // Editor de video
        // Windows
        for ($i = 0; $i < 30; $i++) {
            $sku = $this->generateUniqueSku();
            $editoVideoWin = Software::factory()->create([
                'sku' => $sku,
                'nombre' => 'Editor de Video Windows - '.$sku,
                'precio' => 20,
                'so_id' => 1
            ]);
            Licencia::create([
                'serial' => strtoupper($this->generarSerialUnico()),
                'software_id' => $editoVideoWin->id,
            ]);
        }
    
        // Mac
        for ($i = 0; $i < 30; $i++) {
            $sku = $this->generateUniqueSku();
            $editoVideoMac = Software::factory()->create([
                'sku' => $sku,
                'nombre' => 'Editor de Video Mac - '.$sku,
                'precio' => 22,
                'so_id' => 2
            ]);
            Licencia::create([
                'serial' => strtoupper($this->generarSerialUnico()),
                'software_id' => $editoVideoMac->id,
            ]);
        }
    }
}
