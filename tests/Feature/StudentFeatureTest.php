<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_return_all_students()
    {
        $this->get(route('students.api.index'))
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

    public function test_should_return_student_after_created()
    {
        /** @var Student $student */
        $student = Student::factory()->create();
        $response = $this->get(route('students.api.show', $student->id));

        $response->assertOk();
        $response->assertJsonStructure(
            [
                'message',
                'statusCode',
                'data' => [
                    'name',
                    'cellphone',
                    'email',
                    'birth',
                    'gender',
                    'teams' => [],
                ]
            ]
        );
    }

    public function test_should_delete_student_with_success()
    {
        /** @var Student $student */
        $student = Student::factory()->create();
        $this->delete(route('students.api.destroy', $student->id))
            ->assertOk()
            ->assertJsonStructure(
                [
                    'message',
                    'statusCode',
                    'data'
                ]
            );
    }

    public function test_should_create_student()
    {
        /** @var Team $team */
        $team = Team::factory()->create();

        $data = [
            'name' => 'Escola de teste 1',
            'email' => 'moisesabreurodrigues@gmail.com',
            'birth' => '1998-09-04',
            'team_id' => $team->id
        ];

        $this->post(route('students.api.store'), $data)
            ->assertCreated()
            ->assertJson(
                [
                    'message' => 'Created',
                    'statusCode' => 201,
                    'data' => [
                        'name' => $data['name'],
                        'cellphone' => null,
                        'email' => $data['email'],
                        'birth' => $data['birth'],
                        'gender' => null,
                        'teams' => [
                            [
                                'id' => $team->id,
                                'year' => $team->year,
                                'teach_level' => $team->teach_level,
                                'serie' => $team->serie,
                                'shift' => $team->shift,
                                'created_at' => $team->created_at->format('Y-m-d H:i:s'),
                                'students' => []
                            ]
                        ],
                        'created_at' => $team->created_at->format('Y-m-d H:i:s'),
                    ]
                ]
            );
    }

    public function test_should_update_student()
    {
        $data = [
            'name' => 'Nome atualizado'
        ];

        /** @var Student $student */
        $student = Student::factory()->create();
        $response = $this->put(route('students.api.update', $student->id), $data);
        $response->assertOk();

        $this->assertEquals($data['name'], $response->decodeResponseJson()['data']['name']);
    }
}
