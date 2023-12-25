<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function dataResponse($data = null): JsonResponse
    {
        $response = [
            'data' => $data ?? [],
        ];

        return Response::json($response);
    }

    protected function indexResponse($hasPagination, $data): JsonResponse
    {
        $response = [
            'data' => $hasPagination ? $data->items() : $data->toArray(),
            'page' => $hasPagination ? $this->getPaginationPage($data) : null,
        ];

        return Response::json($response);
    }

    private function getPaginationPage($items): array
    {
        return [
            'total'       => $items->total(),
            'lastPage'    => $items->lastPage(),
            'perPage'     => $items->perPage(),
            'currentPage' => $items->currentPage(),
        ];
    }

}
