<?php

namespace App\Dtos\User;

use App\DTOs\BasePaginationDTO;
use App\Helpers\Maps\MapBasePaginationTrait;

class IndexDto
{
    use MapBasePaginationTrait;

    public BasePaginationDTO|null $pagination = null;

}
