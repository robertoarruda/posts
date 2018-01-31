<?php

namespace App\Http\Controllers\V1;

use App\Services\UserService;
use App\Transformers\V1\UserTransformer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserService $service, UserTransformer $transformer)
    {
        $this->service = $service;
        $this->transformer = $transformer;
    }

    /**
     * Store
     * @param Request $request
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:8',
        ]);

        return parent::store($request);
    }

    /**
     * Update
     * @param Request $request
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $entityId = 0)
    {
        $entityId = $request->user()->id;

        $this->validateUpdate($request, [
            'email' => "email|unique:users,email,{$entityId}",
            'password' => 'min:6|max:8',
        ]);

        return parent::update($request, $entityId);
    }

    /**
     * Destroy
     * @param Request $request
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $entityId = 0)
    {
        $entityId = $request->user()->id;

        return parent::destroy($request, $entityId);
    }
}
