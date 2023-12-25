<?php

namespace App\Helpers\Maps;

use App\Dtos\User\StoreDto;

trait MapUserStoreTrait
{

    public function mapUserStoreDto(object $data): StoreDto
    {
        return new StoreDto(
            $data->login,
            bcrypt($data->password),
            $data->role,
        );
    }

}
