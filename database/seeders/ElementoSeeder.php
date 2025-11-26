<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Elemento;

class ElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar tabla antes de poblar (opcional, pero útil para pruebas repetidas)
        // Elemento::truncate(); // Cuidado con claves foráneas, mejor no usar truncate si hay constraints sin cascade

        $types = [
            'cpu' => [
                'brands' => ['Dell', 'HP', 'Lenovo', 'Asus'],
                'models' => ['OptiPlex 3080', 'ThinkCentre M720', 'ProDesk 600', 'VivoPC'],
                'specs' => [
                    'RAM' => ['8GB', '16GB', '32GB'],
                    'Disk' => ['256GB SSD', '512GB SSD', '1TB HDD'],
                    'Processor' => ['Intel i5', 'Intel i7', 'AMD Ryzen 5']
                ]
            ],
            'switch' => [
                'brands' => ['Cisco', 'TP-Link', 'Ubiquiti'],
                'models' => ['Catalyst 2960', 'TL-SG108', 'UniFi Switch'],
                'specs' => [
                    'Speed' => ['10/100Mbps', '1Gbps'],
                    'Ports' => ['8 puertos', '24 puertos', '48 puertos']
                ]
            ],
            'router' => [
                'brands' => ['Cisco', 'Mikrotik', 'TP-Link'],
                'models' => ['ISR 4000', 'hEX S', 'Archer C7'],
                'specs' => [
                    'Speed' => ['10/100Mbps', '1Gbps'],
                    'Ports' => ['4 puertos', '5 puertos']
                ]
            ],
            'monitor' => [
                'brands' => ['Samsung', 'LG', 'Dell', 'ViewSonic'],
                'models' => ['S24F350', '24MK430', 'P2419H', 'VA2459'],
                'specs' => [
                    'Conn' => ['VGA', 'HDMI', 'DisplayPort', 'VGA/HDMI']
                ]
            ],
            'teclado' => [
                'brands' => ['Logitech', 'Genius', 'Microsoft'],
                'models' => ['K120', 'KB-110', 'Wired 600'],
                'specs' => []
            ],
            'mouse' => [
                'brands' => ['Logitech', 'Genius', 'Microsoft'],
                'models' => ['M90', 'DX-110', 'Basic Optical'],
                'specs' => []
            ],
            'proyector' => [
                'brands' => ['Epson', 'BenQ', 'Sony'],
                'models' => ['PowerLite X41', 'TH685', 'VPL-DX221'],
                'specs' => [
                    'Res' => ['HDMI', 'VGA', '4K']
                ]
            ],
            'disco' => [
                'brands' => ['Western Digital', 'Seagate', 'Kingston'],
                'models' => ['Blue', 'Barracuda', 'A400'],
                'specs' => [
                    'Cap' => ['1TB', '2TB', '500GB', '240GB SSD']
                ]
            ],
            'memoria' => [
                'brands' => ['Kingston', 'Corsair', 'ADATA'],
                'models' => ['ValueRAM', 'Vengeance', 'Premier'],
                'specs' => [
                    'Cap' => ['4GB', '8GB', '16GB']
                ]
            ]
        ];

        $elementos = [];
        $counter = 1;

        foreach ($types as $type => $data) {
            // Generar al menos 3 de cada tipo para tener variedad
            for ($i = 0; $i < 4; $i++) {
                $brand = $data['brands'][array_rand($data['brands'])];
                $model = $data['models'][array_rand($data['models'])];
                
                $descParts = ["$brand $model"];
                
                if ($type === 'cpu') {
                    $ram = $data['specs']['RAM'][array_rand($data['specs']['RAM'])];
                    $disk = $data['specs']['Disk'][array_rand($data['specs']['Disk'])];
                    $proc = $data['specs']['Processor'][array_rand($data['specs']['Processor'])];
                    $descParts[] = "RAM $ram";
                    $descParts[] = "Disco $disk";
                    $descParts[] = "$proc";
                } elseif ($type === 'switch' || $type === 'router') {
                    $speed = $data['specs']['Speed'][array_rand($data['specs']['Speed'])];
                    $ports = $data['specs']['Ports'][array_rand($data['specs']['Ports'])];
                    $descParts[] = "$speed";
                    $descParts[] = "$ports";
                } elseif ($type === 'monitor') {
                    $conn = $data['specs']['Conn'][array_rand($data['specs']['Conn'])];
                    $descParts[] = "$conn";
                } elseif ($type === 'proyector') {
                    $res = $data['specs']['Res'][array_rand($data['specs']['Res'])];
                    $descParts[] = "$res";
                } elseif ($type === 'disco' || $type === 'memoria') {
                    $cap = $data['specs']['Cap'][array_rand($data['specs']['Cap'])];
                    $descParts[] = "$cap";
                }

                $nro_lia = 'LIA' . str_pad($counter, 4, '0', STR_PAD_LEFT);
                $nro_unsj = (rand(0, 1) === 1) ? 'UNSJ' . str_pad($counter, 4, '0', STR_PAD_LEFT) : null;

                $elementos[] = [
                    'nro_lia' => $nro_lia,
                    'nro_unsj' => $nro_unsj,
                    'tipo' => $type,
                    'descripcion' => implode(', ', $descParts),
                    'cantidad' => rand(1, 10)
                ];
                $counter++;
            }
        }

        // Insertar en lotes
        foreach (array_chunk($elementos, 50) as $chunk) {
            Elemento::insert($chunk);
        }
    }
}
