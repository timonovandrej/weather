<?php

namespace Tests\Stub;

use App\Dtos\Currency\StoreDto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait StubCurrency
{
    public function stubAddCurrencies(): void
    {
        $values = [
            [
                'codeA'     => 840,
                'codeB'     => 980,
                'date'      => Carbon::createFromTimestamp(1712005273),
                'rateBuy'   => 40,
                'rateSell'  => 42,
                'rateCross' => 0.1,
                'key'       => '840-980',
            ],
            [
                'codeA'     => 841,
                'codeB'     => 980,
                'date'      => Carbon::createFromTimestamp(1712005273),
                'rateBuy'   => 45,
                'rateSell'  => 55,
                'rateCross' => 4,
                'key'       => '841-980',
            ],
            [
                'codeA'     => 842,
                'codeB'     => 980,
                'date'      => Carbon::createFromTimestamp(1712005273),
                'rateBuy'   => 65,
                'rateSell'  => 99,
                'rateCross' => 3,
                'key'       => '842-980',
            ],
        ];

        DB::table('currencies')->insert($values);
    }

    public function stubRemoveCurrencies(): void
    {
        DB::table('currencies')->whereNotNull('id')->delete();
        DB::statement('ALTER TABLE currencies AUTO_INCREMENT = 1');
    }

    public function getStubCurrenciesStoreDto(): array
    {
        $dtos = [];

        $dtos[] = (new StoreDto(840, 980, 1712005273, 42, 90, 20))->toArray();
        $dtos[] = (new StoreDto(841, 980, 1712005273, 45, 70, 21))->toArray();
        $dtos[] = (new StoreDto(842, 980, 1712005273, 50, 56, 5))->toArray();

        return $dtos;
    }

}
