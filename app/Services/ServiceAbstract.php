<?php

namespace App\Services;

abstract class ServiceAbstract
{
    /**
     * @var App\Repositories\RepositoryAbstract
     */
    protected $repository;

    /**
     * Busca registro pelos parametros
     * @param array $params
     * @return Colletion
     */
    public function find(array $params = [])
    {
        return $this->repository->find($params);
    }

    /**
     * Busca registro pelo id
     * @param int $entityId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById(int $entityId)
    {
        return $this->repository->findById($entityId);
    }

    /**
     * Salva o registro
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Altera o registro
     * @param int $entityId
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $entityId, array $data)
    {
        return $this->repository->update($entityId, $data);
    }

    /**
     * Deleta o registro
     * @param int $entityId
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(int $entityId, array $params = [])
    {
        return $this->repository->delete($entityId);
    }
}
