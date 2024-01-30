<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarTest extends TestCase
{
    /**
     * Testando se a lista de carros é obtida
     */
    public function test_can_get_all_cars(): void
    {
        $response = $this->get('api/cars');

        $response->assertStatus(200);
    }

    /**
     * Testando a criação de novos carros
     */
    public function test_can_create_new_cars(): void
    {
        $data = [
            "name" => fake()->text(75)
        ];

        $response = $this->json('POST', 'api/cars/store', $data);

        $response->assertStatus(201);

        $json = json_decode($response->getContent());

        $this->assertEquals($data['name'], $json->data->name);

    }

    /**
     * Testando remoção de carros
     */
    public function test_can_update_cars(): void
    {
        $car = Car::factory()->create();

        $newData = [
            'name' => fake()->name(),
        ];

        $response = $this->json('PUT', "api/cars/update/{$car->id}", $newData);

        $response->assertStatus(200);

        $find = Car::find($car->id);

        $this->assertEquals($newData["name"], $find->name);
        $this->assertNotEquals($car->name, $find->name);
    }

    /**
     * Testando remoção de carros
     */
    public function test_can_delete_cars(): void
    {
        $car = Car::factory()->create();

        $response = $this->json('DELETE', "api/cars/delete/{$car->id}");

        $response->assertStatus(204);

        $find = Car::find($car->id);

        $this->assertNull($find);

    }
}
