<?php

namespace Tests;

class BaseTestCase extends TestCase
{
    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->removeStubData();
        $this->addStubData();
    }

    protected function tearDown(): void
    {
        $this->removeStubData();
        parent::tearDown();
    }

    protected function removeStubData() { }

    protected function addStubData() { }

    protected function api(): string
    {
        return env('API_URL', 'http://127.0.0.1:8000/api');
    }

    protected function checkExist($data, $fields)
    {
        foreach ($fields as $fieldName) {
            $this->assertTrue(property_exists($data, $fieldName), 'Not found field=' . $fieldName);
        }
    }

    protected function checkNotExist($data, $fields)
    {
        foreach ($fields as $fieldName) {
            $this->assertFalse(property_exists($data, $fieldName), 'Found field=' . $fieldName);
        }
    }

}
