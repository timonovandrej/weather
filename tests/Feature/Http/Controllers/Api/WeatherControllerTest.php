<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Repositories\WeatherRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\BaseTestCase;
use Tests\Stub\StubWeather;


class WeatherControllerTest extends BaseTestCase
{
    use WithoutMiddleware;
    use StubWeather;

    public function __construct($name = null)
    {
        app()->make(WeatherRepository::class);

        parent::__construct($name);
    }

    /**
     * Priority, wrong value validation
     */
    public function testSearchPriorityValidationValueWrong()
    {
        $this
            ->json('GET', $this->api(), $this->priorityValidationValueRequest())
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonStructureSearchValidation2())
            ->assertJsonPath('message', 'The selected priority.value is invalid.');
    }

    /**
     * Priority, wrong type validation
     */
    public function testSearchPriorityValidationTypeWrong()
    {
        $this
            ->json('GET', $this->api(), $this->priorityValidationRequest())
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonStructureSearchValidation())
            ->assertJsonPath('message', 'The priority.value must be an array. (and 1 more error)');
    }

    /**
     * All filters
     */
    public function testSearchAllFilters()
    {
        $this
            ->json('GET', $this->api(), $this->allFiltersRequest())
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureOne());
    }

    /**
     * Get all items without any filters
     */
    public function testSearchNoFilters()
    {
        $this
            ->json('GET', $this->api())
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureOne());
    }

    /**
     * Priority, type 'is' value '[1, 2]'
     */
    public function testSearchPriorityArrayOk()
    {
        $this
            ->json('GET', $this->api(), $this->priorityArrayRequest())
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureOne());
    }


    /**
     * Get weather. City name wrong type
     */
    public function testGetCityNameWrongTypeValidation() //TODO 1 FIXME 1
    {
        $this
            ->json('GET', $this->api(), $this->getWrongTypeValidationRequest())
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
            ->assertJsonStructure($this->jsonStructureEmptyData());
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

    private function jsonStructureSearchValidation(): array
    {
        return [
            'errors' => [
                'priority.value',
                'priority.type',
            ],
            'message',
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

    private function jsonStructureOne(): array
    {
        return [
            'data' => $this->jsonStructureWeather()
        ];
    }

    private function jsonStructureEmptyData(): array
    {
        return [
            'data' => [],
        ];
    }

    private function getRequest(string $cityName): array
    {
        return [
            'cityName' => $cityName,
        ];
    }

    private function getWrongTypeValidationRequest(): array
    {
        return [
            'cityName' => 22,
        ];
    }
}
