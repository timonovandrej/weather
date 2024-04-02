<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CurrencyRepositoryInterface
{

    public function index(): Collection;

    public function store(array $dtos): bool;
}
