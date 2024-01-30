<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Car;

class UserRepository
{
    /**
     * Create a new user in the database
     *
     * @param array $userData
     * @return \App\Models\User
     */
    public function create(array $userData): User
    {
        return User::create($userData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\User  $user
     * @param  array  $userData
     * @return bool
     */
    public function update(User $user, array $userData): bool
    {
        return $user->update($userData);
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }

    /**
     * Attach or detach a car from a user
     *
     * @param User $user
     * @param int $carId
     * @return void
     */
    public function attachToCar(User $user, int $carId)
    {
        $hasCar = $user->cars()->where('car_id', $carId)->exists();

        $car = Car::findOrFail($carId);

        if (!$hasCar) {
            $user->cars()->attach($car);
        } else {
            $user->cars()->detach($car);
        }
    }

    /**
     * Get all cars for a user
     *
     * @param User $user
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllCars(User $user, int $perPage = 10)
    {
        return $user->cars()->paginate($perPage);
    }
}