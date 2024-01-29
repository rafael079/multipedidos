<?php
namespace App\Repositories;

use App\Models\Car;

class CarRepository
{
    public function create(array $carData): Car
    {
        return Car::create($carData);
    }
}