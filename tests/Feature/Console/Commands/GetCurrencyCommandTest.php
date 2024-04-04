<?php

namespace Tests\Feature\Console\Commands;

use App\Console\Commands\Currency\GetCommand;
use Tests\BaseTestCase;


class GetCurrencyCommandTest extends BaseTestCase
{
    protected string $command = 'currency:get';

    /**
     * Get currency from remote server
     */
    public function testGetCurrency()
    {
        $this
            ->artisan(GetCommand::class)
            ->assertExitCode(0);
    }
}
