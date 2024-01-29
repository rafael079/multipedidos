<?php
namespace App\Repositories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarRepository
{
    public function create(array $carData): Car
    {
        return Car::create($carData);
    }

    public function all(): Collection
    {
        return Car::all();
    }

    public function update(Car $car, array $carData): bool
    {
        return $car->update($carData);
    }

    public function delete(Car $car): bool
    {
        return $car->delete();
    }
}