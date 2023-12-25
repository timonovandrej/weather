<?php

namespace App\Dtos;

class BasePaginationDTO
{
    public function __construct(
        public int $perPage = 0,
        public int $currentPage = 0
    ) {
    }
}
