<?php

namespace App\Database\Seeds;


use App\Models\TypeDocumentIdentification;
use CodeIgniter\Database\Seeder;

class TypeDocumentIdentificationSeeder extends  Seeder
{
    public function run()
    {
        $data = [
            [
                'name'            => 'Tarjeta de identidad',
                'description'     => 'Tarjeta de identidad'
            ],
            [
                'name'            => 'Cédula de ciudadanía',
                'description'     => 'Puntaje Estandar'
            ],
            [
                'name'            => 'Tarjeta de extranjería',
                'description'     => 'Puntaje Extraordinario'
            ],
            [
                'name'            => 'Cédula de extranjería',
                'description'     => 'Puntaje Extraordinario'
            ],
            [
                'name'            => 'Pasaporte',
                'description'     => 'Pasaporteo'
            ],
            [
                'name'            => 'Documento de identificación extranjero',
                'description'     => 'Documento de identificación extranjero'
            ],
            [
                'name'            => 'PEP',
                'description'     => 'PEP'
            ],
        ];

        foreach ($data as $item){
            $user = new TypeDocumentIdentification();
            $user->insert($item);
        }
    }
}