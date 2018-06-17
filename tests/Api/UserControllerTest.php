<?php

namespace Tests\Api;

use Tests\ApiTestCase;
use App\Models\User;

class UserTest extends ApiTestCase
{
    /**
     * Setup tests
     */
    public function testSetup() {
        $this->refreshAndSeedDatabase();
        self::assertArrayHasKey('fake', ['fake' => true]);
    }

    public function testGetAll() {
        $jsonResponse = $this->json('GET', '/users');

        // Check status and structure
        $jsonResponse
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        [
                            'id',
                            'name',
                            'email',
                        ],
                    ],
                ]
            );
    }

    public function testPost() {
        $testUser = factory(User::class)->make()->getAttributes();

        $jsonResponse = $this->json('POST', '/users', $testUser);

        unset($testUser['password']);

        // Check status, structure and data
        $jsonResponse
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' => array_merge(
                        array_keys($testUser),
                        [
                            'id',
                        ]
                    )
                ]
            )
            ->assertJsonFragment($testUser);

        // Check password is hidden
        $response = $jsonResponse->decodeResponseJson();
        $this->assertNotContains('password', $response['data']);
    }
}
