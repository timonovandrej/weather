<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;


class CurrencyController extends Controller
{
    public function __construct(
        private readonly CurrencyRepositoryInterface $userRepository,
    ) {
    }

    public function index(): JsonResponse
    {
        $items = $this->userRepository->index();

        return Response::json($items);
    }
}
