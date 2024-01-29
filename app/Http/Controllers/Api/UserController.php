<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function store(UserStoreRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->create($request->validated());

        return (new UserResource($user))->response()->setStatusCode(201);
    }
}
