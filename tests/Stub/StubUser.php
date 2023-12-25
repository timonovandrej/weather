<?php

namespace Tests\Stub;

use App\Dtos\BasePaginationDTO;
use App\Dtos\User\IndexDto;
use App\Dtos\User\StoreDto;
use Illuminate\Support\Facades\DB;

trait StubUser
{
    public function stubAddUsers(): void
    {
        $values = [
            [
                'login'    => 'test-user-1',
                'role'     => 'regular',
                'password' => bcrypt(111),
            ],
            [
                'login'    => 'test-user-2',
                'role'     => 'regular',
                'password' => bcrypt(111),
            ],
            [
                'login'    => 'test-user-3',
                'role'     => 'admin',
                'password' => bcrypt(222),
            ],
        ];

        DB::table('users')->insert($values);
    }

    public function stubRemoveUsers(): void
    {
        DB::table('users')->whereNotNull('id')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
    }

    public function getStubUserStoreDto(): StoreDto
    {
        return
            new StoreDto(
                'test-user-1',
                bcrypt(111),
                'regular',
            );
    }

    public function getStubIndexPaginationDto($perPage): IndexDto
    {
        $dto = new IndexDto();
        $dto->pagination = new BasePaginationDTO($perPage);

        return $dto;
    }
}
