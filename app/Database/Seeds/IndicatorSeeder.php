<?php

namespace App\Database\Seeds;

use App\Models\Indicator;
use CodeIgniter\Database\Seeder;

class IndicatorSeeder extends  Seeder
{
    public function run()
    {
        $data = [
            [
                'percentage'      => '60.00',
                'description'     => 'Puntaje critico'
            ],
            [
                'percentage'      => '100.00',
                'description'     => 'Puntaje Estandar'
            ],
            [
                'percentage'      => '12.00',
                'description'     => 'Puntaje Extraordinario'
            ],
        ];

        foreach ($data as $item){
            $user = new Indicator();
            $user->insert($item);
        }
    }
}