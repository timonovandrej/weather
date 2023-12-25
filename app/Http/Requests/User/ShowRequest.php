<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class ShowRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'id' => 'required|exists:App\Models\User,id',
        ];
    }

    protected function prepareForValidation()
    {
        if (isset($this->id)) {
            $this->merge(['id' => $this->id]);
        }
    }

}
