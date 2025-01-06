<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\InvalidPostException;

class PostTitle
{
    public function __construct(
        private readonly string $title,
    ) {
        $this->validateTitle($title);
    }

    private function validateTitle(string $title): void
    {
        if (empty($title) || \strlen($title) > 255 || \strlen($title) < 1) {
            throw new InvalidPostException('Title must be between 1 and 255 characters');
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
