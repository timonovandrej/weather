<?php

namespace Tests\Unit\Helpers\Maps;

use App\Dtos\User\IndexDto;
use App\Helpers\Maps\MapBasePaginationTrait;
use Tests\BaseTestCase;

class MapBasePaginationTraitTest extends BaseTestCase
{
    use MapBasePaginationTrait;

    /**
     * Check dto mapping. Pagination is null
     */
    public function testMapDtoNull()
    {
        $stub = $this->getStubEmptyData();
        $dto  = $this->mapBasePagination($stub, new IndexDto());

        $this->assertNotNull($dto);
        $this->assertNull($dto->pagination);
    }


    /**
     * Check dto mapping
     */
    public function testMapDto()
    {
        $stub = $this->getStubData();
        $dto  = $this->mapBasePagination($stub, new IndexDto());

        $this->assertNotNull($dto);
        $this->assertNotNull($dto->pagination);

        $this->assertEquals(2, $dto->pagination->perPage);
        $this->assertEquals(3, $dto->pagination->currentPage);
    }

    private function getStubData(): object
    {
        return (object)[
            'page' => (object)[
                'perPage'     => 2,
                'currentPage' => 3,
            ]
        ];
    }

    private function getStubEmptyData(): object
    {
        return (object)[];
    }
}
