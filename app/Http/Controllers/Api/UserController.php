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
    public function store(UserStoreRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->create($request->validated());

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function update(User $user, UserUpdateRequest $request, UserRepository $userRepository)
    {
        $userRepository->update($user, $request->validated());

        return new UserResource($user);
    }
}
