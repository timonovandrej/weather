<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function index(): Collection
    {
        return Currency::all();
    }

    public function store(array $dtos): bool
    {
        Currency::upsert($dtos, 'key');

        return true;
    }
}
