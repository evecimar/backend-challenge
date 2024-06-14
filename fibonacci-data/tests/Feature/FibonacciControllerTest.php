<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\FibonacciQueryFactory; 

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

    public function test_get_fibonacci_query()
    {
        $query = FibonacciQueryFactory::new()->create();

        $response = $this->getJson("/api/fibonacci/{$query->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $query->id,
                     'name' => $query->name,
                     'value' => $query->value,
                     'result' => $query->result,
                 ]);
    }

    public function test_full_update_fibonacci_query()
    {
        $query = FibonacciQueryFactory::new()->create();

        $response = $this->putJson("/api/fibonacci/{$query->id}", ['name' => 'Joao', 'value' => 5]);

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $query->id,
                     'name' => 'Joao',
                     'value' => 5,
                     'result' => 5,
                 ]);
    }

    public function test_partial_update_name_fibonacci_query()
    {
        $query = FibonacciQueryFactory::new()->create();

        $response = $this->patchJson("/api/fibonacci/{$query->id}", ['name' => 'Kamila']);

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $query->id,
                     'name' => 'Kamila',
                     'value' => $query->value,
                     'result' => $query->result,
                 ]);
    }

    public function test_partial_update_value_fibonacci_query()
    {
        $query = FibonacciQueryFactory::new()->create();

        $response = $this->patchJson("/api/fibonacci/{$query->id}", ['value' => 5]);

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $query->id,
                     'name' => $query->name,
                     'value' => 5,
                     'result' => 5,
                 ]);
    }

    public function test_delete_fibonacci_query()
    {
        $query = FibonacciQueryFactory::new()->create();

        $response = $this->deleteJson("/api/fibonacci/{$query->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Fibonacci query deleted successfully']);

        $this->assertDatabaseMissing('fibonacci_queries', ['id' => $query->id]);
    }

}
