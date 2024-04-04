<?php

namespace Tests\Unit\Helpers;

use App\Helpers\MonobankApiHelper;
use Tests\BaseTestCase;

class MonobankApiHelperTest extends BaseTestCase
{

    private MonobankApiHelper $helper;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->helper = app()->make(MonobankApiHelper::class);
    }

    /**
     * Get data from remote monobank server api
     */
    public function testGetCurrencies()
    {
        $currencies = $this->helper->getCurrencies();

        $this->assertNotEmpty($currencies);
    }
}
