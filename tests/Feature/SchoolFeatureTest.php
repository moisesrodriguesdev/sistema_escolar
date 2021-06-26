<?php

namespace Tests\Feature;

use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_return_all_schools()
    {
        $this->get(route('schools.api.index'))
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

    public function test_should_return_school_after_created()
    {
        /** @var School $school */
        $school = School::factory()->create();
        $response = $this->get(route('schools.api.show', $school->id));

        $response->assertOk();
        $response->assertJson(
            [
                'message' => 'OK',
                'statusCode' => 200,
                'data' => [
                    'id' => $school->id,
                    'name' => $school->name,
                    'address' => $school->address,
                    'teams' => [],
                    'created_at' => $school->created_at->format('Y-m-d H:i:s')
                ]
            ]
        );
    }

    public function test_should_delete_school_with_success()
    {
        /** @var School $school */
        $school = School::factory()->create();
        $this->delete(route('schools.api.destroy', $school->id))
            ->assertOk()
            ->assertJsonStructure(
                [
                    'message',
                    'statusCode',
                    'data'
                ]
            );
    }

    public function test_should_create_school()
    {
        $data = [
            'name' => 'Escola de teste 1',
            'address' => 'Endereço de teste'
        ];

        $response = $this->post(route('schools.api.store'), $data)
            ->assertCreated()
            ->assertJsonStructure(
                [
                    'message',
                    'statusCode',
                    'data' => []
                ]
            );

        $this->assertEquals($data['name'], $response->decodeResponseJson()['data']['name']);
        $this->assertEquals($data['address'], $response->decodeResponseJson()['data']['address']);
    }

    public function test_should_update_school()
    {
        $data = [
            'name' => 'Escola atualizado'
        ];

        /** @var School $school */
        $school = School::factory()->create();
        $response = $this->put(route('schools.api.update', $school->id), $data);
        $response->assertOk();

        $this->assertEquals($data['name'], $response->decodeResponseJson()['data']['name']);
    }
}
