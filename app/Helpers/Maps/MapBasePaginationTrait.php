<?php

namespace App\Helpers\Maps;

use App\DTOs\BasePaginationDTO;

trait MapBasePaginationTrait
{
    protected function mapBasePagination(object $data, $dto)
    {
        $page = $data->page ?? null;

        if ($page) {
            $dto->pagination = new BasePaginationDTO($page->perPage, $page->currentPage);
        }

        return $dto;
    }

}
