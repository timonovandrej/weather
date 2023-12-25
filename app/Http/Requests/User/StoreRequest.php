<?php

namespace App\Http\Requests\User;

use App\Dtos\User\StoreDto;
use App\Helpers\Maps\MapUserStoreTrait;
use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    use MapUserStoreTrait;

    public function rules()
    {
        return [
            'login'    => 'required|string|min:3|max:255|unique:users',
            'password' => 'required|string|min:3',
            'role'     => 'required|in:regular,admin',
        ];
    }

    public function getStoreDTO(): StoreDto
    {
        return $this->mapUserStoreDto((object)$this->all());
    }

}
