<?php

namespace Tests\Unit\Helpers\Maps;

use App\Helpers\Maps\MapUserStoreTrait;
use Tests\BaseTestCase;

class MapUserStoreTraitTest extends BaseTestCase
{
    use MapUserStoreTrait;

    /**
     * Check correct dto setting
     */
    public function testMapDto()
    {
        $stub = $this->getStubData();
        $dto = $this->mapUserStoreDto($stub);

        $this->assertEquals('test-user-login', $dto->login);
        $this->assertNotEquals('111', $dto->password);
        $this->assertEquals('regular', $dto->role);
    }

    private function getStubData(): object
    {
        return (object)[
            'login' => 'test-user-login',
            'password' => '111',
            'role' => 'regular',
        ];
    }
}
