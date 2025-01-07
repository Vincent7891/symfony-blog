<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidPostException;

class PostContent
{
    public function __construct(
        private readonly string $post,
    ) {
        $this->validatePost($post);
    }

    private function validatePost(string $post): void
    {
        if (empty($post)) {
            throw new InvalidPostException('Content cannot be empty');
        }
    }

    public function getPost(): string
    {
        return $this->post;
    }
}
