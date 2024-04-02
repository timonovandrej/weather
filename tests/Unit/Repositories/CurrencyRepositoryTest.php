<?php

namespace Tests\Unit\Repositories;

use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Tests\BaseTestCase;
use Tests\Stub\StubCurrency;

class CurrencyRepositoryTest extends BaseTestCase
{
    use StubCurrency;

    private CurrencyRepository $repository;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->repository = app()->make(CurrencyRepository::class);
    }

    /**
     * Get currencies
     */
    public function testIndex()
    {
        $currencies = $this->repository->index();
        $this->assertNotEmpty($currencies);
        $this->assertCount(3, $currencies);

        $currency = (object)$currencies[0]->toArray();
        $this->checkFirstCurrency($currency, [840, 980, 40, 42, 0.1, '840-980']);
    }

    /**
     * Store currencies. DB has data
     */
    public function testUpdateStore()
    {
        $currencies = $this->getCurrencies();
        $this->assertCount(3, $currencies);
        $this->checkFirstCurrency((object)$currencies[0], [840, 980, 40, 42, 0.1, '840-980']);

        $dtos     = $this->getStubCurrenciesStoreDto();
        $isStored = $this->repository->store($dtos);
        $this->assertTrue($isStored);

        $currencies = $this->getCurrencies();
        $this->assertCount(3, $currencies);
        $this->checkFirstCurrency((object)$currencies[0], [840, 980, 42, 90, 20, '840-980']);
    }

    /**
     * Store currencies. DB is empty
     */
    public function testStore()
    {
        $this->stubRemoveCurrencies();
        $this->assertCount(0, $this->getCurrencies());

        $dtos     = $this->getStubCurrenciesStoreDto();
        $isStored = $this->repository->store($dtos);

        $this->assertTrue($isStored);

        $currencies = $this->getCurrencies();
        $this->assertCount(3, $currencies);
        $this->checkFirstCurrency((object)$currencies[0], [840, 980, 42, 90, 20, '840-980']);
    }

    protected function addStubData()
    {
        $this->stubAddCurrencies();
    }

    protected function removeStubData()
    {
        $this->stubRemoveCurrencies();
    }

    protected function checkFirstCurrency(object $currency, array $values)
    {
        $this->checkExist($currency, $this->fieldsCurrency());

        $this->assertEquals($values[0], $currency->codeA);
        $this->assertEquals($values[1], $currency->codeB);
        $this->assertEquals($values[2], $currency->rateBuy);
        $this->assertEquals($values[3], $currency->rateSell);
        $this->assertEquals($values[4], $currency->rateCross);
        $this->assertEquals($values[5], $currency->key);
    }


    private function getCurrencies(): array
    {
        return Currency::all()->toArray();
    }

    private function fieldsCurrency(): array
    {
        return [
            'id',
            'codeA',
            'codeB',
            'codeB',
            'date',
            'rateBuy',
            'rateSell',
            'rateCross',
            'created_at',
            'updated_at',
        ];
    }
}
