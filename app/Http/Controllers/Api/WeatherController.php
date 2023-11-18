<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeatherGetRequest;
use App\Http\Requests\WeatherStoreRequest;
use App\Repositories\Interfaces\WeatherRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;


class WeatherController extends Controller
{
    public function __construct(
        private readonly WeatherRepositoryInterface $repository,
    ) {
    }

    public function show(WeatherGetRequest $request): JsonResponse
    {
        $items = $this->repository->show($request->getCityName());

        return $this->responseData($items);
    }

    public function store(WeatherStoreRequest $request): JsonResponse
    {
        $itemId = $this->repository->store($request->getWeatherStoreDto());

        return $this->responseData($itemId);
    }

    private function responseData($data):JsonResponse {
        return Response::json(['data' => $data]);
    }
}
