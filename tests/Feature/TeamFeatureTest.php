<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\Student;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamFeatureTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_return_all_teams()
    {
        $this->get(route('teams.api.index'))
            ->assertOk()
            ->assertJsonStructure(
                [
                    'message',
                    'statusCode',
                    'data' => [
                        'items' => []
                    ]
                ]
            );
    }

    public function test_should_return_team_after_created()
    {
        /** @var Team $team */
        $team = Team::factory()->create();
        $response = $this->get(route('teams.api.show', $team->id));

        $response->assertOk();
        $response->assertJsonStructure(
            [
                'message',
                'statusCode',
                'data' => [
                    'id',
                    'year',
                    'teach_level',
                    'serie',
                    'shift',
                    'created_at',
                    'students',
                ]
            ]
        );
    }

    public function test_should_delete_team_with_success()
    {
        /** @var Team $team */
        $team = Team::factory()->create();
        $this->delete(route('teams.api.destroy', $team->id))
            ->assertOk()
            ->assertJsonStructure(
                [
                    'message',
                    'statusCode',
                    'data'
                ]
            );
    }

    public function test_should_create_team()
    {
        /** @var School $school */
        $school = School::factory()->create();

        $data = [
            'shift' => 'Integral',
            'year' => 2021,
            'teach_level' => 'Médio',
            'serie' => '5',
            'school_id' => $school->id,
        ];

        $response = $this->post(route('teams.api.store'), $data);

        $response->assertCreated();
        $response->assertJson(
            [
                'message' => 'Created',
                'statusCode' => 201,
                'data' => [
                    'id' => $response->assertJsonStructure()['data']['id'],
                    'year' => $data['year'],
                    'teach_level' => $data['teach_level'],
                    'serie' => (int)$data['serie'],
                    'shift' => $data['shift'],
                    'created_at' => now()->format('Y-m-d H:i:s'),
                    'students' => [],
                ]
            ]
        );
    }

    public function test_should_update_team()
    {
        $studentTeste1 = Student::factory()->create();
        $studentTeste2 = Student::factory()->create();
        $school = School::factory()->create();

        $data = [
            'students' => [
                $studentTeste1->id,
                $studentTeste2->id,
            ],
            'school_id' => $school->id
        ];

        /** @var Team $team */
        $team = Team::factory()->create();

        $response = $this->put(route('teams.api.update', $team->id), $data)
            ->assertOk();

        $this->assertEquals(
            [
                [
                    'name' => $studentTeste1->name,
                    'cellphone' => $studentTeste1->cellphone
                ],
                [
                    'name' => $studentTeste2->name,
                    'cellphone' => $studentTeste2->cellphone
                ]
            ]
            ,
            $response->decodeResponseJson()['data']['students']
        );
    }
}
