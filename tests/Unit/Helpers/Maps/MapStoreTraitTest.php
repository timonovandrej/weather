<?php

namespace Tests\Unit\Helpers\Maps;

use App\Helpers\Maps\MapStoreTrait;
use Tests\BaseTestCase;

class MapStoreTraitTest extends BaseTestCase
{
    use MapStoreTrait;

    /**
     * Check correct dto. Some fields are empty
     */
    public function testMapDtoEmptyFields()
    {
        $stub = $this->getStubDataEmpty();
        $dto  = $this->mapCurrencyStoreDto($stub);

        $this->assertEquals(840, $dto->codeA);
        $this->assertEquals(980, $dto->codeB);
        $this->assertEquals('1712005273', $dto->date);
        $this->assertEquals('', $dto->rateBuy);
        $this->assertEquals('', $dto->rateSell);
        $this->assertEquals('', $dto->rateCross);
        $this->assertEquals('840-980', $dto->getKey());
    }

    /**
     * Check correct dto
     */
    public function testMapDto()
    {
        $stub = $this->getStubData();
        $dto  = $this->mapCurrencyStoreDto($stub);

        $this->assertEquals(840, $dto->codeA);
        $this->assertEquals(980, $dto->codeB);
        $this->assertEquals('1712005273', $dto->date);
        $this->assertEquals('38.95', $dto->rateBuy);
        $this->assertEquals('39.3592', $dto->rateSell);
        $this->assertEquals('0.0141', $dto->rateCross);
        $this->assertEquals('840-980', $dto->getKey());
    }

    private function getStubDataEmpty(): object
    {
        return (object)[
            'currencyCodeA' => 840,
            'currencyCodeB' => 980,
            'date'          => 1712005273,
        ];
    }

    private function getStubData(): object
    {
        return (object)[
            'currencyCodeA' => 840,
            'currencyCodeB' => 980,
            'date'          => 1712005273,
            'rateBuy'       => 38.95,
            'rateSell'      => 39.3592,
            'rateCross'     => 0.0141,
        ];
    }
}
