<?php

namespace App\Database\Seeds;

use App\Models\TypeWork;
use CodeIgniter\Database\Seeder;

class TypeWorkSeeder extends  Seeder
{
    public function run()
    {
        $data = [
            [
                'name'            => 'Proyecto',
                'description'     => 'Proyecto'
            ],
            [
                'name'            => 'Mesa Ayuda',
                'description'     => 'Mesa Ayuda'
            ],
            [
                'name'            => 'Pesos',
                'description'     => 'Pesos'
            ],
        ];

        foreach ($data as $item){
            $user = new TypeWork();
            $user->insert($item);
        }
    }
}