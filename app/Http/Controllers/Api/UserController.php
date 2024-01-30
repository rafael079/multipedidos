<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserConnectCarRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\CarResource;
use App\Http\Resources\UserResource;
use App\Models\Car;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserStoreRequest  $request
     * @return \\Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepository->create($request->validated());

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @param  \App\Models\User $user
     * @return \App\Http\Resources\UserResource
     */
    public function update(User $user, UserUpdateRequest $request): UserResource
    {
        $this->userRepository->update($user, $request->validated());

        return new UserResource($user);
    }

    /**
     * Deletes the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user): \Illuminate\Http\Response
    {
        $this->userRepository->delete($user);

        return response('', 204);
    }

    /**
     * Attach the given user to the given car.
     *
     * @param User $user
     * @param UserConnectCarRequest $request
     * @return \Illuminate\Http\Response
     */
    public function attach(User $user, UserConnectCarRequest $request): \Illuminate\Http\Response
    {
        $this->userRepository->attachToCar($user, $request->validated('car_id'));

        return response('', 204);
    }

    /**
     * Get the cars that belong to the given user.
     *
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function cars(User $user): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $userCars = $this->userRepository->getAllCars($user, request()->get('perPage', 10));

        return CarResource::collection($userCars);
    }
}
