<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use Helpers;

    protected $service;

    protected $transformer;

    /**
     * Index
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->service->find();

        $response = $this->response->collection($data, $this->transformer);

        return $response;
    }

    /**
     * Show
     * @param Request $request
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $entityId)
    {
        $data = $this->service->findById($entityId);

        $response = $this->response->item($data, $this->transformer);

        return $response;
    }

    /**
     * Store
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->service->create($request->all());

        $response = $this->response->created('', $data);

        return $response;
    }

    /**
     * Update
     * @param Request $request
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $entityId)
    {
        $data = $this->service->update($entityId, $request->all());

        $response = $this->response->accepted('', $data);

        return $response;
    }

    /**
     * Destroy
     * @param Request $request
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $entityId)
    {
        $this->service->delete($entityId, $request->all());

        $response = $this->response->noContent();

        return $response;
    }

    /**
     * validateStore
     * @param Request $request
     * @param array $rules
     */
    protected function validateStore(Request $request, array $rules)
    {
        return $this->validateRequest($request, $rules, StoreResourceFailedException::class);

    }

    /**
     * validateUpdate
     * @param Request $request
     * @param array $rules
     */
    protected function validateUpdate(Request $request, array $rules)
    {
        return $this->validateRequest($request, $rules, UpdateResourceFailedException::class);

    }

    /**
     * validateRequest
     * @param Request $request
     * @param array $rules
     * @param string $exception
     */
    protected function validateRequest(Request $request, array $rules, string $exception)
    {
        try {
            $this->validate($request, $rules);
        } catch (Exception $e) {
            throw new $exception('', $e->errors());
        }

    }
}
