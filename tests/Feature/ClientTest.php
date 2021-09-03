<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertJson;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_client_index()
    {
        $response = $this->get('/api/client');
        $response->assertStatus(200);
    }

    public function test_client_post()
    {
        $response = $this->postJson('/api/client', ['nome' => 'Testunit', 'email' => 'testUnit@mail']);

        $response->assertJson(['created' => 'success']);
    }
}
