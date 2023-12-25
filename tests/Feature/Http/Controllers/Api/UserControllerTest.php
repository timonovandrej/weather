<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Repositories\UserRepository;
use Tests\BaseTestCase;
use Tests\Stub\StubUser;


class UserControllerTest extends BaseTestCase
{
    use StubUser;

    public function __construct($name = null)
    {
        app()->make(UserRepository::class);

        parent::__construct($name);
    }

    /**
     * Delete user. Wrong id
     */
    public function testDestroyWrongId()
    {
        $response = $this->json('DELETE', $this->api(-1));
        $this->checkIdInvalid($response);
    }

    /**
     * Delete user
     */
    public function testDestroy()
    {
        $this
            ->json('DELETE', $this->api(1))
            ->assertStatus(200);
    }

    /**
     * Edit user. Wrong user id
     */
    public function testEditWrongUserId()
    {
        $response = $this->json('PUT', $this->api(-1), $this->editRequest());
        $this->checkIdInvalid($response);
    }

    /**
     * Edit user
     */
    public function testEdit()
    {
        $this
            ->json('PUT', $this->api(1), $this->editRequest())
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureStore())
            ->assertJsonFragment(['data' => 1]);
    }

    /**
     * Store user. Validation
     */
    public function testStoreValidation()
    {
        $this
            ->json('POST', $this->api())
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonStructureStoreValidation())
            ->assertJsonPath('message', 'The login field is required. (and 2 more errors)')
            ->assertJsonPath('errors.login.0', 'The login field is required.')
            ->assertJsonPath('errors.password.0', 'The password field is required.')
            ->assertJsonPath('errors.role.0', 'The role field is required.');
    }

    /**
     * Store user
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
     * Get user. Wrong id
     */
    public function testGetWrongId()
    {
        $response = $this->json('GET', $this->api(-1));
        $this->checkIdInvalid($response);
    }

    /**
     * Get user
     */
    public function testGet()
    {
        $this
            ->json('GET', $this->api(1))
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureOne());
    }

    protected function checkIdInvalid($response)
    {
        $response->assertStatus(422)
                 ->assertJsonStructure($this->jsonStructureValidationId())
                 ->assertJsonPath('message', 'The selected id is invalid.')
                 ->assertJsonPath('errors.id.0', 'The selected id is invalid.');
    }


    protected function addStubData()
    {
        $this->stubAddUsers();
    }

    protected function removeStubData()
    {
        $this->stubRemoveUsers();
    }

    protected function api(string $uri = ''): string
    {
        return parent::api() . '/users/' . $uri;
    }

    private function jsonStructureStoreValidation(): array
    {
        return [
            'errors' => [
                'login',
                'password',
                'role',
            ],
            'message',
        ];
    }


    private function jsonStructureValidationId(): array
    {
        return [
            'message',
            'errors' => [
                'id',
            ],
        ];
    }


    private function jsonStructureOne(): array
    {
        return [
            'data' => [
                'id',
                'login',
                'role',
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

    private function storeRequest(): array
    {
        return [
            'login'    => 'test-user-login-1',
            'password' => '111',
            'role'     => 'regular'
        ];
    }

    private function editRequest(): array
    {
        return [
            'login'    => 'test-user-1',
            'password' => '111',
            'role'     => 'admin'
        ];
    }
}
