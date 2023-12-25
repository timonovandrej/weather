<?php

namespace Tests\Unit\Repositories;

use App\Dtos\User\IndexDto;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;
use Tests\Stub\StubUser;

class UserRepositoryTest extends BaseTestCase
{
    use StubUser;

    private UserRepository $repository;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->repository = app()->make(UserRepository::class);
    }

    /**
     * Delete user
     */
    public function testDestroy()
    {
        $this->assertCount(3, $this->getUsers());

        $isDeleted = $this->repository->destroy(1);

        $this->assertTrue($isDeleted);
        $this->assertCount(2, $this->getUsers());
    }

    /**
     * Edit user
     */
    public function testEdit()
    {
        $this->assertCount(3, $this->getUsers());
        $user = $this->getUser(1);
        $this->assertEquals('regular', $user->role);

        $dto       = $this->getStubUserStoreDto();
        $dto->role = 'admin';
        $userId    = $this->repository->edit(1, $dto);

        $this->assertCount(3, $this->getUsers());
        $this->assertEquals(1, $userId);

        $user = $this->getUser($userId);
        $this->assertNotNull($user);

        $this->assertEquals(1, $user->id);
        $this->assertEquals('test-user-1', $user->login);
        $this->assertEquals('admin', $user->role);
    }

    /**
     * Store user
     */
    public function testStore()
    {
        $this->stubRemoveUsers();
        $this->assertCount(0, $this->getUsers());

        $dto    = $this->getStubUserStoreDto();
        $userId = $this->repository->store($dto);

        $this->assertEquals(1, $userId);

        $user = $this->getUser($userId);
        $this->assertNotNull($user);

        $this->assertEquals(1, $user->id);
        $this->assertEquals('test-user-1', $user->login);
        $this->assertEquals('regular', $user->role);
    }

    /**
     * Get all users. With pagination
     */
    public function testIndexPagination()
    {
        $dto = $this->getStubIndexPaginationDto(2);

        $users = $this->repository->index($dto);
        $this->checkPagination($users);

        $user = (object)$users->items()[0]->toArray();
        $this->checkUserFields($user);
    }

    /**
     * Get all users without pagination
     */
    public function testIndex()
    {
        $users = $this->repository->index(new IndexDto());

        $this->assertNotNull($users);
        $this->assertCount(3, $users);

        $user = (object)$users->toArray()[0];
        $this->checkUserFields($user);
    }

    protected function checkUserFields($user): void
    {
        $this->checkExist($user, $this->fieldsUsers());
        $this->checkNotExist($user, $this->fieldsNotExistsUsers());
    }

    protected function checkPagination($data): void
    {
        $items = $data->items();
        $this->assertNotNull($items);
        $this->assertCount(2, $items);
        $this->assertEquals(3, $data->total());
        $this->assertEquals(2, $data->perPage());
        $this->checkExist((object)$data->toArray(), ['total', 'last_page', 'per_page', 'current_page']);
    }

    protected function addStubData()
    {
        $this->stubAddUsers();
    }

    protected function removeStubData()
    {
        $this->stubRemoveUsers();
    }

    protected function getUsers(): array
    {
        return DB::table('users')->get()->toArray();
    }

    protected function getUser($id): object
    {
        return DB::table('users')->find($id);
    }

    private function fieldsUsers(): array
    {
        return [
            'id',
            'login',
            'role',
            'created_at',
            'updated_at',
        ];
    }

    private function fieldsNotExistsUsers(): array
    {
        return [
            'password',
        ];
    }

}
