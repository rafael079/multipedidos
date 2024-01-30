<?php
namespace App\Repositories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarRepository
{
    /**
     * Creates a new car record in the database.
     *
     * @param array $carData The data to be stored in the car record.
     * @return Car The created car record.
     */
    public function create(array $carData): Car
    {
        return Car::create($carData);
    }

    /**
     * Returns all cars from the database.
     *
     * @return Collection<Car>
     */
    public function all(): Collection
    {
        return Car::all();
    }

    /**
     * Updates an existing car record in the database.
     *
     * @param Car $car The car record to be updated.
     * @param array $carData The data to be updated in the car record.
     * @return bool True if the car record was updated, false otherwise.
     */
    public function update(Car $car, array $carData): bool
    {
        return $car->update($carData);
    }

    /**
     * Deletes an existing car record from the database.
     *
     * @param Car $car The car record to be deleted.
     * @return bool True if the car record was deleted, false otherwise.
     */
    public function delete(Car $car): bool
    {
        return $car->delete();
    }
}