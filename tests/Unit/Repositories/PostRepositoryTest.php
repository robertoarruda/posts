<?php

namespace Tests\Repositories;

use App\Post;
use App\Repositories\PostRepository;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Repositories\PostRepository
 */
class PostRepositoryTest extends TestCase
{
    protected $testedClassName = PostRepository::class;

    public function setUp()
    {
        $this->dependencies = [
            Post::class => Mockery::mock(Post::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new PostRepository(...array_values($this->dependencies));

        $this->assertInstanceOf(PostRepository::class, $testedClass);
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $posts = factory(Post::class, 1)->make();

        $this->dependencies[Post::class]
            ->shouldReceive('where->get')
            ->with(['id' => 1])
            ->with()
            ->once()
            ->andReturn($posts);

        $this->assertEquals(
            $posts,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $post = factory(Post::class)->make();

        $this->dependencies[Post::class]
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($post);

        $this->assertEquals(
            $post,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $post = factory(Post::class)->make();

        $this->dependencies[Post::class]
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
     * @covers ::update
     */
    public function testUpdate()
    {
        $post = factory(Post::class)->make();

        $this->dependencies[Post::class]
            ->shouldReceive('where->first->fill->saveOrFail')
            ->with('id', 1)
            ->with()
            ->with($post->toArray())
            ->with()
            ->once()
            ->andReturn(true);

        $this->dependencies[Post::class]
            ->shouldReceive('find')
            ->with(1)
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
        $this->dependencies[Post::class]
            ->shouldReceive('where->delete')
            ->with('id', 1)
            ->with()
            ->once()
            ->andReturn($this->dependencies[Post::class]);

        $this->assertInstanceOf(
            Post::class,
            $this->testedClass->delete(1)
        );
    }
}
