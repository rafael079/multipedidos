<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Car;

class UserRepository
{
    public function create(array $userData): User
    {
        return User::create($userData);
    }

    public function update(User $user, array $userData): bool
    {
        return $user->update($userData);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function connectToCar(User $user, int $carId)
    {
        $hasCar = $user->cars()->where('car_id', $carId)->exists();

        if (!$hasCar) {
            $car = Car::findOrFail($carId);
            $user->cars()->attach($car);
        }

    }

    public function disconnectToCar(User $user, int $carId)
    {
        $hasCar = $user->cars()->where('car_id', $carId)->exists();

        if ($hasCar) {
            $car = Car::findOrFail($carId);
            $user->cars()->detach($car);
        }

    }
}