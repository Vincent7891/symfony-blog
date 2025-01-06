<?php

namespace App\Domain\Model;
use App\Domain\Exception\InvalidPostException;

class PostContent
{
    public function __construct(
        private readonly string $post,
    ){
        $this->validatePost($post);
    }

    private function validatePost(string $post): void
    {
        if(empty($post)) {
            throw new InvalidPostException(
                'Content cannot be empty'
            );
        }
    }
    public function getPost(): string
    {
        return $this->post;
    }
}
