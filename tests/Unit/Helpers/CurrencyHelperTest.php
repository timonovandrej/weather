<?php

namespace Tests\Unit\Helpers;

use App\Helpers\CurrencyHelper;
use Tests\BaseTestCase;

class CurrencyHelperTest extends BaseTestCase
{

    private CurrencyHelper $helper;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->helper = app()->make(CurrencyHelper::class);
    }

    /**
     * Compare new and old data. New and old datas are difference
     */
    public function testGetNewChangedCurrenciesDifference()
    {
        $newData = [['key' => '890-320', 'rate' => 22]];
        $oldData = [['id' => 1, 'key' => '890-320', 'rate' => 2230]];

        $changedData = $this->helper->getNewChangedCurrencies($newData, $oldData);

        $this->assertNotEmpty($changedData);
        $this->assertCount(1, $changedData);
        $this->assertEquals('890-320', $changedData[0]['key']);
        $this->assertEquals('22', $changedData[0]['rate']);
    }

    /**
     * Compare new and old data. Old data is same as new data
     */
    public function testGetNewChangedCurrenciesSame()
    {
        $newData = [['key' => '890-320', 'rate' => 2230]];
        $oldData = [['key' => '890-320', 'rate' => 2230]];

        $changedData = $this->helper->getNewChangedCurrencies($newData, $oldData);

        $this->assertEmpty($changedData);
    }

    /**
     * Compare new and old data. Old data is empty
     */
    public function testGetNewChangedCurrenciesOldDataEmpty()
    {
        $newData = [['key' => '890-320', 'rate' => 2230]];
        $oldData = [];

        $changedData = $this->helper->getNewChangedCurrencies($newData, $oldData);

        $this->assertNotEmpty($changedData);
        $this->assertCount(1, $changedData);
        $this->assertEquals('890-320', $changedData[0]['key']);
        $this->assertEquals('2230', $changedData[0]['rate']);
    }
}
