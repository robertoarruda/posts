<?php

namespace App\Transformers\V1;

use App\User;
use League\Fractal\TransformerAbstract;

/**
 * User transformer
 */
class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        $data = [
            'id' => $user->id ?? null,
            'name' => $user->name ?? null,
            'email' => $user->email ?? null,
        ];

        return array_filter($data);
    }
}
