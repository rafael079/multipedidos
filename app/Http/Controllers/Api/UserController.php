<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserConnectCarRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
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

    public function store(UserStoreRequest $request)
    {
        $user = $this->userRepository->create($request->validated());

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $this->userRepository->update($user, $request->validated());

        return new UserResource($user);
    }

    public function delete(User $user)
    {
        $this->userRepository->delete($user);

        return response('', 204);
    }

    public function connect(User $user, UserConnectCarRequest $request)
    {
        $this->userRepository->connectToCar($user, $request->validated('car_id'));

        return response('', 204);
    }

    public function disconnect(User $user, UserConnectCarRequest $request)
    {
        $this->userRepository->disconnectToCar($user, $request->validated('car_id'));

        return response('', 204);
    }
}
