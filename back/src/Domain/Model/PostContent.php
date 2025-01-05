<?php

namespace App\Domain\Model;

use App\Domain\Exception\InvalidPostException;

class PostContent
{
    public function __construct(
        public readonly string $post,
    ){
        if (empty($post)) {
            throw new InvalidPostException(
                'Content cannot be empty'
            );
        }
    }
    public function getPost(): string {
        return $this->post;
    }
}
