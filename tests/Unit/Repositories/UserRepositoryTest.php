<?php

namespace Tests\Repositories;

use App\Repositories\UserRepository;
use App\User;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Repositories\UserRepository
 */
class UserRepositoryTest extends TestCase
{
    protected $testedClassName = UserRepository::class;

    public function setUp()
    {
        $this->dependencies = [
            User::class => Mockery::mock(User::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new UserRepository(...array_values($this->dependencies));

        $this->assertInstanceOf(UserRepository::class, $testedClass);
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $users = factory(User::class, 1)->make();

        $this->dependencies[User::class]
            ->shouldReceive('where->get')
            ->with(['id' => 1])
            ->with()
            ->once()
            ->andReturn($users);

        $this->assertEquals(
            $users,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $user = factory(User::class)->make();

        $this->dependencies[User::class]
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($user);

        $this->assertEquals(
            $user,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $user = factory(User::class)->make();

        $this->dependencies[User::class]
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
     * @covers ::update
     */
    public function testUpdate()
    {
        $user = factory(User::class)->make();

        $this->dependencies[User::class]
            ->shouldReceive('where->first->fill->saveOrFail')
            ->with('id', 1)
            ->with()
            ->with($user->toArray())
            ->with()
            ->once()
            ->andReturn(true);

        $this->dependencies[User::class]
            ->shouldReceive('find')
            ->with(1)
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
        $this->dependencies[User::class]
            ->shouldReceive('where->delete')
            ->with('id', 1)
            ->with()
            ->once()
            ->andReturn($this->dependencies[User::class]);

        $this->assertInstanceOf(
            User::class,
            $this->testedClass->delete(1)
        );
    }
}
