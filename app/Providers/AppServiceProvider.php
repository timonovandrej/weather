<?php

namespace App\Providers;

use App\Helpers\Interfaces\ApiHelperInterface;
use App\Helpers\MonobankApiHelper;
use App\Repositories\CurrencyRepository;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(ApiHelperInterface::class, MonobankApiHelper::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
    }
}
