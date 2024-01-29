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
}