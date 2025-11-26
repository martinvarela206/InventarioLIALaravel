<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Movimiento::insert([
            ['nro_lia' => 'LIA001', 'user_id' => 1, 'estado' => 'ingresado', 'ubicacion' => 'Deposito', 'fecha' => '2023-01-10 09:00:00', 'comentario' => 'Ingreso inicial'],
            ['nro_lia' => 'LIA001', 'user_id' => 2, 'estado' => 'funcionando', 'ubicacion' => 'Laboratorio 1', 'fecha' => '2023-01-15 10:30:00', 'comentario' => 'Instalado en puesto 1'],
            ['nro_lia' => 'LIA002', 'user_id' => 1, 'estado' => 'ingresado', 'ubicacion' => 'Deposito', 'fecha' => '2023-02-01 08:00:00', 'comentario' => 'Compra nueva'],
            ['nro_lia' => 'LIA002', 'user_id' => 3, 'estado' => 'prestado', 'ubicacion' => 'Oficina Docentes', 'fecha' => '2023-02-05 14:00:00', 'comentario' => 'Prestado a Prof. X'],
            ['nro_lia' => 'LIA003', 'user_id' => 1, 'estado' => 'ingresado', 'ubicacion' => 'Deposito', 'fecha' => '2023-03-10 11:00:00', 'comentario' => 'Donación'],
            ['nro_lia' => 'LIA004', 'user_id' => 1, 'estado' => 'ingresado', 'ubicacion' => 'Deposito', 'fecha' => '2023-03-12 09:30:00', 'comentario' => null],
            ['nro_lia' => 'LIA004', 'user_id' => 2, 'estado' => 'dado de baja', 'ubicacion' => 'Deposito Residuos', 'fecha' => '2023-04-01 16:00:00', 'comentario' => 'Falla irreparable'],
        ]);
    }
}
