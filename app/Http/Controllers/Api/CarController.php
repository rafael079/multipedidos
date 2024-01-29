<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;

class CarController extends Controller
{

    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index()
    {
        $cars = $this->carRepository->all();

        return CarResource::collection($cars);
    }

    public function store(CarStoreRequest $request)
    {
        $car = $this->carRepository->create($request->validated());

        return (new CarResource($car))->response()->setStatusCode(201);
    }

    public function update(Car $car, CarUpdateRequest $request)
    {
        $this->carRepository->update($car, $request->validated());

        return new CarResource($car);
    }

    public function delete(Car $car)
    {
        $this->carRepository->delete($car);

        return response('', 204);
    }
}
