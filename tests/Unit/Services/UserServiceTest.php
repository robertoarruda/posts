<?php

namespace Tests\Services;

use App\Repositories\UserRepository;
use App\Services\UserService;
use App\User;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Services\UserService
 */
class UserServiceTest extends TestCase
{
    protected $testedClassName = UserService::class;

    public function setUp()
    {
        $this->dependencies = [
            UserRepository::class => Mockery::mock(UserRepository::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new UserService(...array_values($this->dependencies));

        $this->assertInstanceOf(UserService::class, $testedClass);
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $user = factory(User::class)->make();

        $this->dependencies[UserRepository::class]
            ->shouldReceive('create')
            ->with($user->toArray())
            ->once()
            ->andReturn($user);

        $this->assertEquals(
            $user,
            $this->testedClass->create($user->toArray())
        );
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $users = factory(User::class, 1)->make(['id' => 1]);

        $this->dependencies[UserRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1])
            ->once()
            ->andReturn($users);

        $this->assertEquals(
            $users,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::find
     */
    public function testFindComplete()
    {
        $users = factory(User::class, 10)->make(['id' => 1]);

        $this->dependencies[UserRepository::class]
            ->shouldReceive('find')
            ->with([])
            ->once()
            ->andReturn($users);

        $this->dependencies[UserRepository::class]
            ->shouldReceive('findById')
            ->times(10);

        $this->assertEquals(
            $users,
            $this->testedClass->find([], 'complete')
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $user = factory(User::class)->make(['id' => 1]);

        $this->dependencies[UserRepository::class]
            ->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($user);

        $this->assertEquals(
            $user,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::update
     * @covers \App\Services\ServiceAbstract::update
     */
    public function testUpdate()
    {
        $user = factory(User::class)->make(['id' => 1]);

        $this->dependencies[UserRepository::class]
            ->shouldReceive('update')
            ->with(1, $user->toArray())
            ->once()
            ->andReturn($user);

        $this->assertEquals(
            $user,
            $this->testedClass->update(1, $user->toArray())
        );
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $user = factory(User::class)->make(['id' => 1]);

        $this->dependencies[UserRepository::class]
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn($user);

        $this->assertEquals(
            $user,
            $this->testedClass->delete(1)
        );
    }
}
