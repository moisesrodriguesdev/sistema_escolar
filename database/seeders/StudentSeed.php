<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert(
            [
                [
                    'name' => 'Francisco Jose Santos',
                    'cellphone' => '85987009517',
                    'email' => 'francisco.jose@gmail.com',
                    'birth' => '1964-02-02',
                    'gender' => 'masculino',
                    'team_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Jessica dos santos castro',
                    'cellphone' => '85987659774',
                    'email' => 'jessica.castro@hotmail.com',
                    'birth' => '1987-02-25',
                    'gender' => 'feminino',
                    'team_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Moises abreu rodrigues',
                    'cellphone' => '85987543697',
                    'email' => 'moises.rodrigues@gmail.com',
                    'birth' => '1998-09-04',
                    'gender' => 'masculino',
                    'team_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }
}
