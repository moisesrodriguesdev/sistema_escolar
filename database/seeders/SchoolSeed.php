<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert(
            [
                [
                    'name' => 'Colégio Ari de Sá',
                    'address' => 'Av. Washington Soares, 3737 - Edson Queiroz, Fortaleza - CE, 60810-350',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Colégio Farias Brito',
                    'address' => 'Rua Salvador Correia de Sá, 1111',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'EEEP Comendador Miguel Gurgel',
                    'address' => 'R. José Baíma - Messejana, Fortaleza - CE',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'EEEP Jose de Alencar',
                    'address' => 'Conj Sítio São João, R. Verde Um, 44 - Jangurussu, Fortaleza - CE',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }
}
