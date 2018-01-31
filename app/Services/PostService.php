<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService extends ServiceAbstract
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Altera o registro
     * @param int $postId
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $postId, array $data)
    {
        $this->postBelongs2User($postId, $data['user_id']);

        return parent::update($postId, $data);
    }

    /**
     * Deleta o registro
     * @param int $postId
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(int $postId, array $params = [])
    {
        $this->postBelongs2User($postId, $params['user_id']);

        return parent::delete($postId);
    }

    /**
     * Verifica se post pertence ao usuario
     * @param int $postId
     * @param int $userId
     * @return boolean
     */
    private function postBelongs2User(int $postId, int $userId)
    {
        $post = $this->repository
            ->find(['id' => $postId, 'user_id' => $userId])
            ->first() ?? null;

        if (empty($post)) {
            throw new \InvalidArgumentException('Invalid post id');
        }

        return true;
    }
}
