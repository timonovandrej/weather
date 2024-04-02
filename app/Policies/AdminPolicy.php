<?php

namespace App\Policies;

use App\Models\Currency;

class AdminPolicy
{
    public function crud(Currency $user): bool
    {
        return $user->role === 'admin';
    }
}
