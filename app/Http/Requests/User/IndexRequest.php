<?php

namespace App\Http\Requests\User;

use App\Dtos\User\IndexDto;
use App\Helpers\Maps\MapBasePaginationTrait;
use App\Http\Requests\BaseRequest;

class IndexRequest extends BaseRequest
{

    use MapBasePaginationTrait;

    public function rules()
    {
        return [
            'cityName' => 'required|string',
        ];
    }

    public function getIndexDTO(): IndexDto
    {
        return $this->mapBasePagination((object)$this->all(), new IndexDto());
    }
}
