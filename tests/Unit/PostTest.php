<?php

namespace Tests;

use App\Post;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Post
 */
class PostTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = Post::class;

    /**
     * @covers ::user
     */
    public function testRelationWithUser()
    {
        $user = factory(User::class)->create();
        $employee = factory(Post::class)
            ->create(['user_id' => $user->id]);

        $this->assertEquals(
            $user->toArray(),
            $employee->user->toArray()
        );
    }
}
