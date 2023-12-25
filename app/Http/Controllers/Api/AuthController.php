<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    public function __construct(
        // TODO 1 Add AuthRepository
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    // TODO 1 Add sanctum token
    public function login(LoginRequest $request): JsonResponse
    {
//        $items = $this->userRepository->index($request->getIndexDTO());
        $token = ['token' => 'user-sanctum-token'];

        return $this->dataResponse($token);
    }

}
