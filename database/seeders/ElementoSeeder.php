<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Elemento::insert([
            ['nro_lia' => 'LIA001', 'nro_unsj' => 'UNSJ001', 'tipo' => 'cpu', 'descripcion' => 'CPU Dell OptiPlex 3080, RAM 8GB, Disco 1TB, Intel i5', 'cantidad' => 10],
            ['nro_lia' => 'LIA002', 'nro_unsj' => 'UNSJ002', 'tipo' => 'monitor', 'descripcion' => 'Monitor Samsung 24 pulgadas, Full HD', 'cantidad' => 5],
            ['nro_lia' => 'LIA003', 'nro_unsj' => null, 'tipo' => 'teclado', 'descripcion' => 'Teclado Logitech K120', 'cantidad' => 20],
            ['nro_lia' => 'UNSJ003', 'nro_unsj' => 'UNSJ003', 'tipo' => 'mouse', 'descripcion' => 'Mouse inalámbrico Logitech M185', 'cantidad' => 15],
            ['nro_lia' => 'LIA004', 'nro_unsj' => 'UNSJ004', 'tipo' => 'impresora', 'descripcion' => 'Impresora HP LaserJet Pro M404dn', 'cantidad' => 3],
        ]);
    }
}
