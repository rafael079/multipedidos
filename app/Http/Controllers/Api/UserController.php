<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
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
}
