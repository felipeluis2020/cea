<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['code' => 'CC',  'name' => 'Cédula de Ciudadanía'],
            ['code' => 'TI',  'name' => 'Tarjeta de Identidad'],
            ['code' => 'CE',  'name' => 'Cédula de Extranjería'],
            ['code' => 'PPT', 'name' => 'Permiso por Protección Temporal'],
            ['code' => 'PAS', 'name' => 'Pasaporte'],
            ['code' => 'NIT', 'name' => 'Número de Identificación Tributaria'],
        ];

        foreach ($types as $type) {
            DocumentType::updateOrCreate(['code' => $type['code']], $type);
        }
    }
}