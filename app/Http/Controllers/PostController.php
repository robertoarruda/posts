<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(PostService $service, PostTransformer $transformer)
    {
        $this->service = $service;
        $this->transformer = $transformer;
    }

    /**
     * Store
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => $request->user()->id ?? 0]);

        return parent::store($request);
    }

    /**
     * Update
     * @param Request $request
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $entityId)
    {
        $request->merge(['user_id' => $request->user()->id ?? 0]);

        return parent::update($request, $entityId);
    }

    /**
     * Destroy
     * @param Request $request
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $entityId)
    {
        $request->merge(['user_id' => $request->user()->id ?? 0]);

        return parent::destroy($request, $entityId);
    }
}
