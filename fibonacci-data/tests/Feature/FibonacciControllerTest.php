<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FibonacciControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_fibonacci_calculation()
    {
        $response = $this->postJson('/api/fibonacci', ['name' => 'Alice', 'value' => 10]);

        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Alice',
                     'value' => 10,
                     'result' => 55,
                 ]);
    }

}
