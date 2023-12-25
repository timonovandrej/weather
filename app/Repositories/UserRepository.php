<?php

namespace App\Repositories;

use App\Dtos\User\IndexDto;
use App\Dtos\User\StoreDto;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class UserRepository implements UserRepositoryInterface
{

    public function index(IndexDto $dto): Collection|LengthAwarePaginator|null
    {
        $query = User::query();

        if ($dto->pagination) {
            return
                $query
                    ?->paginate(
                    $dto->pagination->perPage,
                    ['*'],
                    'page',
                    $dto->pagination->currentPage
                );
        }

        return $query?->get();
    }

    public function show(int $id): ?object
    {
        $user = User::where('id', $id)->first();

        return json_decode($user?->toJson());
    }

    public function store(StoreDto $dto): int
    {
        $data = [
            'login'    => $dto->login,
            'password' => $dto->password,
            'role'     => $dto->role,
        ];

        return User::updateOrCreate(['login' => $dto->login], $data)->id;
    }

    public function edit(int $id, StoreDto $dto): int
    {
        return $this->store($dto);
    }

    public function destroy(int $id): ?bool
    {
        return User::find($id)?->delete();
    }

}
