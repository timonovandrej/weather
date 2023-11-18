<?php

namespace Tests\Unit\Repositories;

use App\Models\Weather;
use App\Repositories\WeatherRepository;
use Carbon\Carbon;
use Tests\BaseTestCase;
use Tests\Stub\StubWeather;

class WeatherRepositoryTest extends BaseTestCase
{
    use StubWeather;

    private WeatherRepository $repository;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->repository = app()->make(WeatherRepository::class);
    }

    /**
     * Store city. Weather exist. Lower case. It means cityName 'test-1' is same 'TEST-1' or 'tESt-1'
     */
    public function testStoreExistLowerCase()
    {
        $this->checkId1MinTmp('12.2');

        $dto  = $this->getStubWeatherEditLowerCaseDto();
        $itemId = $this->repository->store($dto);

        $this->assertEquals(1, $itemId);

        $this->checkId1MinTmp('-100');
    }


    /**
     * Store city. Weather exist
     */
    public function testStoreExist()
    {
        $this->checkId1MinTmp('12.2');

        $dto  = $this->getStubWeatherEditDto();
        $itemId = $this->repository->store($dto);

        $this->assertEquals(1, $itemId);

        $this->checkId1MinTmp('-100');
    }

    /**
     * Store city. Weather not exist
     */
    public function testStore()
    {
        $this->stubRemoveWeathers();
        $this->assertCount(0, $this->getWeathers());

        $dto  = $this->getStubWeatherStoreDto();
        $itemId = $this->repository->store($dto);

        $this->assertEquals(1, $itemId);

        $items = $this->getWeathers();
        $this->assertCount(1, $items);

        $this->checkGet((object)$items[0]);
    }

    /**
     * Get weather by city name. lower case check
     */
    public function testGetLowerCaseName()
    {
        $item = $this->repository->show('TEsT-CiTY-1');
        $this->checkGet($item);
    }

    /**
     * Get weather by city name. wrong city name
     */
    public function testGetWrongCityName()
    {
        $item = $this->repository->show('wrong city name');
        $this->assertNull($item);
    }

    /**
     * Get weather by city name. correct
     */
    public function testGet()
    {
        $item = $this->repository->show('test-city-1');
        $this->checkGet($item);
    }

    protected function checkGet(object $item): void
    {
        $this->assertNotNull($item);
        $this->assertEquals(1, $item->id);
        $this->assertEquals('test-city-1', $item->city_name);
        $this->assertEquals('12.2', $item->min_tmp);
        $this->assertEquals('33.2', $item->max_tmp);
        $this->assertEquals('15.6', $item->wind_spd);
        $this->assertEquals(Carbon::create(2020, 10, 25, 12, 00), $item->timestamp_dt);
    }

    protected function checkId1MinTmp($minTemp): void {
        $items = $this->getWeathers();
        $this->assertCount(3, $items);
        $this->assertEquals(1, $items[0]['id']);
        $this->assertEquals($minTemp, $items[0]['min_tmp']);
    }

    protected function addStubData()
    {
        $this->stubAddWeathers();
    }

    protected function removeStubData()
    {
        $this->stubRemoveWeathers();
    }

    protected function getWeathers(): array
    {
        return Weather::all()->toArray();
    }

}
