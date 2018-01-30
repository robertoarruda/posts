<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserService $service, UserTransformer $transformer)
    {
        $this->service = $service;
        $this->transformer = $transformer;
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
