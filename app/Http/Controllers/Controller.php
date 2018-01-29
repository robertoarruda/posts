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
     * Show
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = $this->service->find();

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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $entityId = $request->user()->id;

        $data = $this->service->update($entityId, $request->all());

        $response = $this->response->item($data, $this->transformer);

        return $response;
    }

    /**
     * Destroy
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $entityId = $request->user()->id;

        $this->service->delete($entityId);

        $response = $this->response->noContent();

        return $response;
    }
}
