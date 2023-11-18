<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Repositories\WeatherRepository;
use Tests\BaseTestCase;
use Tests\Stub\StubWeather;


class WeatherControllerTest extends BaseTestCase
{
    use StubWeather;

    public function __construct($name = null)
    {
        app()->make(WeatherRepository::class);

        parent::__construct($name);
    }

    /**
     * Store weather. Validation
     */
    public function testStoreValidation()
    {
        $this
            ->json('POST', $this->api())
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonStructureStoreValidation())
            ->assertJsonPath('message', 'The city name field is required. (and 4 more errors)')
            ->assertJsonPath('errors.cityName.0', 'The city name field is required.')
            ->assertJsonPath('errors.minTmp.0', 'The min tmp field is required.')
            ->assertJsonPath('errors.maxTmp.0', 'The max tmp field is required.')
            ->assertJsonPath('errors.windSpd.0', 'The wind spd field is required.')
            ->assertJsonPath('errors.timestampDt.0', 'The timestamp dt field is required.');
    }

    /**
     * Store weather. Validation wrong types
     */
    public function testStoreValidationWrongTypes()
    {
        $this
            ->json('POST', $this->api(), $this->storeValidationWrongTypeRequest())
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonStructureStoreValidation())
            ->assertJsonPath('message', 'The city name must be a string. (and 4 more errors)')
            ->assertJsonPath('errors.cityName.0', 'The city name must be a string.')
            ->assertJsonPath('errors.minTmp.0', 'The min tmp must be a number.')
            ->assertJsonPath('errors.maxTmp.0', 'The max tmp must be between -100 and 100.')
            ->assertJsonPath('errors.windSpd.0', 'The wind spd must be between 0 and 400.')
            ->assertJsonPath('errors.timestampDt.0', 'The timestamp dt must be between  1 and 4102444800.');
    }

    /**
     * Store weather
     */
    public function testStore()
    {
        $this
            ->json('POST', $this->api(), $this->storeRequest())
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureStore())
            ->assertJsonFragment(['data' => 4]);
    }

    /**
     * Get weather. City name wrong type
     */
    public function testGetCityNameWrongTypeValidation()
    {
        $this
            ->json('GET', $this->api(), $this->getRequest(11))
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonStructureGetValidation())
            ->assertJsonPath('message', 'The city name must be a string.')
            ->assertJsonPath('errors.cityName.0', 'The city name must be a string.');
    }

    /**
     * Get weather. Empty city. No param
     */
    public function testGetEmptyCityValidation()
    {
        $this
            ->json('GET', $this->api())
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonStructureGetValidation())
            ->assertJsonPath('message', 'The city name field is required.')
            ->assertJsonPath('errors.cityName.0', 'The city name field is required.');
    }

    /**
     * Get weather. Wrong city name
     */
    public function testGetWrongCityName()
    {
        $this
            ->json('GET', $this->api(), $this->getRequest('WrongCityName'))
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureStore())
            ->assertJsonFragment(['data' => null]);
    }

    /**
     * Get weather. City name has trims
     */
    public function testGetTrims()
    {
        $this
            ->json('GET', $this->api(), $this->getRequest('    test-city-1   '))
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureOne());
    }

    /**
     * Get weather. City name correct
     */
    public function testGet()
    {
        $this
            ->json('GET', $this->api(), $this->getRequest('test-city-1'))
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureOne());
    }

    protected function addStubData()
    {
        $this->stubAddWeathers();
    }

    protected function removeStubData()
    {
        $this->stubRemoveWeathers();
    }

    protected function api(string $uri = ''): string
    {
        return parent::api() . '/weather/' . $uri;
    }

    private function jsonStructureWeather(): array
    {
        return [
            'id',
            'city_name',
            'min_tmp',
            'max_tmp',
            'wind_spd',
            'timestamp_dt',
            'created_at',
            'updated_at',
        ];
    }

    private function jsonStructureGetValidation(): array
    {
        return [
            'errors' => [
                'cityName',
            ],
            'message',
        ];
    }

    private function jsonStructureStoreValidation(): array
    {
        return [
            'errors' => [
                'cityName',
                'minTmp',
                'maxTmp',
                'windSpd',
                'timestampDt',
            ],
            'message',
        ];
    }

    private function jsonStructureOne(): array
    {
        return [
            'data' => [
                'id',
                'city_name',
                'min_tmp',
                'max_tmp',
                'wind_spd',
                'timestamp_dt',
                'created_at',
                'updated_at',
            ]
        ];
    }

    private function jsonStructureStore(): array
    {
        return [
            'data'
        ];
    }

    private function jsonStructureEmptyData(): array
    {
        return [
            'data' => [],
        ];
    }

    private function getRequest(string|int $cityName): array
    {
        return [
            'cityName' => $cityName,
        ];
    }

    private function storeRequest(): array
    {
        return [
            'cityName'    => 'Test city name',
            'minTmp'      => -10,
            'maxTmp'      => 52,
            'windSpd'     => 15.6,
            'timestampDt' => 1700308800
        ];
    }

    private function storeValidationWrongTypeRequest(): array
    {
        return [
            'cityName'    => 23,
            'minTmp'      => 'StringBytNotNumber',
            'maxTmp'      => -500,
            'windSpd'     => 602,
            'timestampDt' => '7258118405'
        ];
    }
}
