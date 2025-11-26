<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Elemento;
use App\Models\Movimiento;
use Carbon\Carbon;

class MovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elementos = Elemento::all();
        $users = [1, 2]; // Admin, Coordinador (IDs asumidos de UserSeeder)
        $locations = ['LIA', 'Administracion', 'Prestado', 'Lab FB', 'Lab Hardware', 'Of Redes', 'Lab Redes'];
        $states = ['ingresado', 'funcionando', 'guardado', 'prestado', 'dado de baja'];

        foreach ($elementos as $elemento) {
            $movementsCount = rand(1, 5);
            $currentDate = Carbon::now()->subMonths(rand(6, 24)); // Fecha de inicio aleatoria

            // 1. Movimiento Inicial
            $initialUser = $users[array_rand($users)];
            Movimiento::create([
                'nro_lia' => $elemento->nro_lia,
                'user_id' => $initialUser,
                'estado' => 'ingresado',
                'ubicacion' => 'LIA',
                'fecha' => $currentDate->copy(),
                'comentario' => 'Ingreso inicial al sistema'
            ]);

            // 2. Movimientos subsiguientes
            for ($i = 1; $i < $movementsCount; $i++) {
                $currentDate->addDays(rand(5, 60)); // Avanzar fecha
                $user = $users[array_rand($users)];
                
                $state = $states[array_rand($states)];
                $location = 'LIA';
                $comment = 'Movimiento registrado';

                // Lógica específica por estado
                if ($state === 'dado de baja') {
                    $location = 'Dado de Baja';
                    $comment = 'Por resolucion Nro ' . rand(100000, 999999);
                    
                    Movimiento::create([
                        'nro_lia' => $elemento->nro_lia,
                        'user_id' => $user,
                        'estado' => $state,
                        'ubicacion' => $location,
                        'fecha' => $currentDate->copy(),
                        'comentario' => $comment
                    ]);
                    break; // Detener generación si se da de baja
                } elseif ($state === 'prestado') {
                    $location = 'Prestado';
                    $comment = 'Prestamo a docente/alumno';
                } elseif ($state === 'funcionando' || $state === 'guardado') {
                    $validLocs = array_diff($locations, ['Dado de Baja', 'Prestado']);
                    $location = $validLocs[array_rand($validLocs)];
                    $comment = 'Asignado a ' . $location;
                } elseif ($state === 'ingresado') {
                     $location = 'LIA';
                     $comment = 'Reingreso a depósito';
                }

                Movimiento::create([
                    'nro_lia' => $elemento->nro_lia,
                    'user_id' => $user,
                    'estado' => $state,
                    'ubicacion' => $location,
                    'fecha' => $currentDate->copy(),
                    'comentario' => $comment
                ]);
            }
        }
    }
}
