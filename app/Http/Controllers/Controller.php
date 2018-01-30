<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->service->find();

        $response = $this->response->item($data, $this->transformer);

        return $response;
    }

    /**
     * Show
     * @param int $companyId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function show(int $entityId)
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

        $response = $this->response->item($data, $this->transformer);

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
}
