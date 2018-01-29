<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends ServiceAbstract
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Altera o registro
     * @param int $entityId
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $entityId, array $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        return parent::update($entityId, $data);
    }
}
