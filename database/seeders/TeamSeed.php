<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert(
            [
                [
                    'year' => '2020',
                    'teach_level' => Team::FUNDAMENTAL,
                    'serie' => '5',
                    'shift' => 'Manhã',
                    'school_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'year' => '2020',
                    'teach_level' => Team::MEDIO,
                    'serie' => '2',
                    'shift' => 'Tarde',
                    'school_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'year' => '2021',
                    'teach_level' => Team::MEDIO,
                    'serie' => '3',
                    'shift' => 'Tarde',
                    'school_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }
}
