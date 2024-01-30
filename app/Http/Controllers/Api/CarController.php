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
    /**
     * @param CarRepository $carRepository
     */
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * Returns a collection of cars
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $cars = $this->carRepository->all();

        return CarResource::collection($cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CarStoreRequest  $request
     * @return \\Illuminate\Http\JsonResponse
     */
    public function store(CarStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $car = $this->carRepository->create($request->validated());

        return (new CarResource($car))->response()->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CarUpdateRequest $request
     * @param  \App\Models\Car $car
     * @return \App\Http\Resources\CarResource
     */
    public function update(Car $car, CarUpdateRequest $request): CarResource
    {
        $this->carRepository->update($car, $request->validated());

        return new CarResource($car);
    }

    /**
     * Deletes the specified resource from storage.
     *
     * @param Car $car
     * @return \Illuminate\Http\Response
     */
    public function delete(Car $car): \Illuminate\Http\Response
    {
        $this->carRepository->delete($car);

        return response('', 204);
    }
}
