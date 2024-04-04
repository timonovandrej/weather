<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;


class CurrencyController extends Controller
{
    public function __construct(
        private CurrencyRepositoryInterface $userRepository,
    ) {
    }

    public function index(): JsonResponse
    {
        $items = $this->userRepository->index();

        return Response::json($items);
    }
}
