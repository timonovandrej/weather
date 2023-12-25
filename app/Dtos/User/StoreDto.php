<?php

namespace App\Dtos\User;

class StoreDto
{
    public function __construct(
        public string $login,
        public string $password,
        public string $role,
    ) {
    }
}
