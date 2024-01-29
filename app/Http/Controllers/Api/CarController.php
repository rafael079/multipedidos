<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;
use App\Http\Resources\CarResource;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function store(CarStoreRequest $request, CarRepository $carRepository)
    {
        $car = $carRepository->create($request->validated());

        return (new CarResource($car))->response()->setStatusCode(201);
    }
}
