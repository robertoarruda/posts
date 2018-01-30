<?php

namespace App\Transformers;

use App\Post;
use League\Fractal\TransformerAbstract;

/**
 * Post transformer
 */
class PostTransformer extends TransformerAbstract
{
    public function transform(Post $post)
    {
        $data = [
            'id' => $post->id ?? null,
            'user' => $post->user ?? null,
            'post' => $post->post ?? null,
            'created_at' => $post->created_at ?? null,
            'updated_at' => $post->updated_at ?? null,
        ];

        return array_filter($data);
    }
}
