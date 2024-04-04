<?php

namespace App\Console\Commands\Currency;

use App\Events\NotificationEvent;
use App\Helpers\CurrencyHelper;
use App\Helpers\Interfaces\ApiHelperInterface;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use Illuminate\Console\Command;

class GetCommand extends Command
{
    protected $signature = 'currency:get';
    protected $description = 'Get currency from remote server. And send notification event';

    public function __construct(
        private ApiHelperInterface $apiHelper,
        private CurrencyHelper $currencyHelper,
        private CurrencyRepositoryInterface $currencyRepository,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $newData = $this->apiHelper->getCurrencies();
        $oldData = $this->currencyRepository->index()->toArray();

        $changedCurrencies = $this->currencyHelper->getNewChangedCurrencies($newData, $oldData);
        $isSaved           = $this->currencyRepository->store($changedCurrencies);

        if ($isSaved && ! empty($changedCurrencies)) {
            event(new NotificationEvent($changedCurrencies));
        }

        return Command::SUCCESS;
    }
}
