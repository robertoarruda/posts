<?php

namespace App\Repositories;

use App\Post;

/**
 * Post repository
 */
class PostRepository extends RepositoryAbstract
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }
}
