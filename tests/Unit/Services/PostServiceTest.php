<?php

namespace Tests\Services;

use App\Post;
use App\Repositories\PostRepository;
use App\Services\PostService;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Services\PostService
 */
class PostServiceTest extends TestCase
{
    protected $testedClassName = PostService::class;

    protected $activeReflection = true;

    public function setUp()
    {
        $this->dependencies = [
            PostRepository::class => Mockery::mock(PostRepository::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new PostService(...array_values($this->dependencies));

        $this->assertInstanceOf(PostService::class, $testedClass);
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $post = factory(Post::class)->make();

        $this->dependencies[PostRepository::class]
            ->shouldReceive('create')
            ->with($post->toArray())
            ->once()
            ->andReturn($post);

        $this->assertEquals(
            $post,
            $this->testedClass->create($post->toArray())
        );
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $posts = factory(Post::class, 1)->make(['id' => 1]);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1])
            ->once()
            ->andReturn($posts);

        $this->assertEquals(
            $posts,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::find
     */
    public function testFindComplete()
    {
        $posts = factory(Post::class, 10)->make(['id' => 1]);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('find')
            ->with([])
            ->once()
            ->andReturn($posts);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('findById')
            ->times(10);

        $this->assertEquals(
            $posts,
            $this->testedClass->find([], 'complete')
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $post = factory(Post::class)->make(['id' => 1]);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($post);

        $this->assertEquals(
            $post,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::update
     * @covers \App\Services\ServiceAbstract::update
     */
    public function testUpdate()
    {
        $posts = factory(Post::class, 1)->make(['id' => 1]);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1, 'user_id' => 1])
            ->once()
            ->andReturn($posts);

        $post = factory(Post::class)->make(['id' => 1]);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('update')
            ->with(1, $post->toArray())
            ->once()
            ->andReturn($post);

        $this->assertEquals(
            $post,
            $this->testedClass->update(1, $post->toArray())
        );
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $posts = factory(Post::class, 1)->make(['id' => 1]);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1, 'user_id' => 1])
            ->once()
            ->andReturn($posts);

        $post = factory(Post::class)->make(['id' => 1]);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn($post);

        $this->assertEquals(
            $post,
            $this->testedClass->delete(1, $post->toArray())
        );
    }

    /**
     * @covers ::postBelongs2User
     */
    public function testPostBelongs2User()
    {
        $method = $this->reflection->getMethod('postBelongs2User');
        $method->setAccessible(true);

        $posts = factory(Post::class, 1)->make(['id' => 1]);

        $this->dependencies[PostRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1, 'user_id' => 10])
            ->once()
            ->andReturn($posts);

        $this->assertTrue($method->invoke($this->testedClass, 1, 10));
    }

    /**
     * @covers ::postBelongs2User
     */
    public function testPostBelongs2UserError()
    {
        $method = $this->reflection->getMethod('postBelongs2User');
        $method->setAccessible(true);

        $posts = factory(Post::class, 0)->make();

        $this->dependencies[PostRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1, 'user_id' => 10])
            ->once()
            ->andReturn($posts);

        $this->expectExceptionMessage('Invalid post id');
        $this->expectException(\InvalidArgumentException::class);

        $method->invoke($this->testedClass, 1, 10);
    }
}
