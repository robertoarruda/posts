<?php

namespace Tests;

use App\Post;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\User
 */
class UserTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = User::class;

    /**
     * @covers ::posts
     */
    public function testRelationWithPost()
    {
        $user = factory(User::class)->create();
        $posts = factory(Post::class, 5)
            ->create(['user_id' => $user->id]);

        $this->assertEquals(
            $posts->toArray(),
            $user->posts->toArray()
        );
    }

    /**
     * @covers ::setPasswordAttribute
     */
    public function testSetPasswordAttribute()
    {
        $hash = $this->testedClass->setPasswordAttribute('password');

        $this->assertAttributeEquals(
            ['password' => $hash],
            'attributes',
            $this->testedClass
        );
    }
}
