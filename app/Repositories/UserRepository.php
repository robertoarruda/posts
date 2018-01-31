<?php

namespace App\Repositories;

use App\User;

/**
 * User repository
 */
class UserRepository extends RepositoryAbstract
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
