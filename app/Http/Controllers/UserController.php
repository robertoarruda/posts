<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Transformers\UserTransformer;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct(UserService $service, UserTransformer $transformer)
    {
        $this->service = $service;
        $this->transformer = $transformer;
    }
}
