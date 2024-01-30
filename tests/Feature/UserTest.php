<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Testando cadastro de usuário
     */
    public function test_can_create_new_user(): void
    {
        $data = [
            "name" => fake()->name(),
            "email" => fake()->freeEmail(),
            "password" => 'password'
        ];

        $response = $this->json('POST', 'api/users/store', $data);

        $response->assertStatus(201);

        $json = json_decode($response->getContent());

        $this->assertEquals($data['name'], $json->data->name);
        $this->assertEquals($data['email'], $json->data->email);
    }

    /**
     * Testando cadastro de usuário
     */
    public function test_can_attach_car_to_user(): void
    {
        $car = Car::factory()->create();

        $user = User::factory()->create();

        $data = [
            'car_id' => $car->id,
        ];

        $response = $this->json('PATCH', "api/users/attach/{$user->id}", $data);

        $userCar = User::find($user->id)->cars()->first();

        $response->assertStatus(204);

        $this->assertEquals($data['car_id'], $userCar->pivot->car_id);
    }

    /**
     * Testando update de usuário
     */
    public function test_can_update_update_user(): void
    {
        $user = User::factory()->create();

        $newData = [
            "email" => fake()->email(),
            "password" => 'password'
        ];

        $response = $this->json('PUT', "api/users/update/{$user->id}", $newData);

        $response->assertStatus(200);

        $find = User::find($user->id);

        $this->assertEquals($newData['email'], $find->email);
        $this->assertNotEquals($user->email, $find->email);
    }

    /**
     * Testando exclusão de usuário
     */
    public function test_can_delete_user(): void
    {
        $user = User::factory()->create();

        $response = $this->json('DELETE', "api/users/delete/{$user->id}");

        $response->assertStatus(204);

        $find = User::find($user->id);

        $this->assertNull($find);
    }
}
