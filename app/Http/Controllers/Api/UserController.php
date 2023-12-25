<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\ShowRequest;
use App\Http\Requests\User\StoreRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function index(IndexRequest $request): JsonResponse
    {
        $items = $this->userRepository->index($request->getIndexDTO());

        return $this->indexResponse($request->hasPagination(), $items);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $userId = $this->userRepository->store($request->getStoreDTO());

        return $this->dataResponse($userId);
    }

    public function edit(int $id, EditRequest $request): JsonResponse
    {
        $userId = $this->userRepository->edit($id, $request->getStoreDTO());

        return $this->dataResponse($userId);
    }

    public function show(int $id, ShowRequest $request): JsonResponse
    {
        $user = $this->userRepository->show($id);

        return $this->dataResponse($user);
    }

    public function destroy(int $id, ShowRequest $request): JsonResponse
    {
        $this->userRepository->destroy($id);

        return $this->dataResponse();
    }
}
