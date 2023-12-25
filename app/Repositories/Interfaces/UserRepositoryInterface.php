<?php

namespace App\Repositories\Interfaces;

use App\Dtos\User\IndexDto;
use App\Dtos\User\StoreDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{

    public function index(IndexDto $dto): Collection|LengthAwarePaginator|null;

    public function show(int $id): ?object;

    public function store(StoreDto $dto): int;

    public function edit(int $id, StoreDTO $dto): int;

    public function destroy(int $id): ?bool;
}
