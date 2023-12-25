<?php

namespace App\Http\Requests\User;

use App\Helpers\Maps\MapUserStoreTrait;
use App\Http\Requests\BaseRequest;

class EditRequest extends StoreRequest
{
    use MapUserStoreTrait;


    public function rules()
    {
        return [
            ...parent::rules(),
            'id' => 'required|exists:App\Models\User,id',
            'login'    => 'required|string|min:3|max:255',
        ];
    }
}
