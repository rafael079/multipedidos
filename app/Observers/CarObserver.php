<?php

namespace App\Observers;

use App\Models\Car;

class CarObserver
{
    /**
     * Handle the Car "deleted" event.
     */
    public function deleted(Car $car): void
    {
        $car->users()->detach();
    }
}
