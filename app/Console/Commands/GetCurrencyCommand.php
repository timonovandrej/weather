<?php

namespace App\Console\Commands;

use App\Helpers\Interfaces\ApiHelperInterface;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use Illuminate\Console\Command;

class GetCurrencyCommand extends Command
{
    protected $signature = 'currency:get';
    protected $description = 'Get currency from remote server';

    public function __construct(
        private readonly ApiHelperInterface $apiHelper,
        private readonly CurrencyRepositoryInterface $currencyRepository,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $dtos     = $this->apiHelper->getCurrencies();
        $response = $this->currencyRepository->store($dtos);

        if ($response) {
            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}
