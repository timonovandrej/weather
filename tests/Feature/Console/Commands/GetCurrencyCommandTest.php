<?php

namespace Tests\Feature\Console\Commands;

use App\Models\Currency;
// use Mockery;
use Tests\BaseTestCase;

//use Tests\Unit\BaseTestCase;


class GetCurrencyCommandTest extends BaseTestCase
{
    protected string $command = 'currency:get';

    /**
     * Get currency from remote server
     */
    public function testGetCurrency()
    {
//        $this->stubServices(true);

        $command = "{$this->command}";

        $this
            ->artisan($command)
            ->expectsOutput(0);
//            ->expectsOutput("Create user command... finished");
    }
}
