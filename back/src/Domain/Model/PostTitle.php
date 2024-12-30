<?php

namespace App\Domain\Model;

use App\Domain\Exception\InvalidPostException;

class PostTitle
{
    public function __construct(
        private readonly string $title,
    )
    {
        // create seperate method and then call in constructor
        if (empty($title) || strlen($title) > 255 || strlen($title) < 1 ) {
            throw new invalidPostException("Title must be between 1 and 255 characters");
        }
    }
    public function getTitle(): string
    {
        return $this->title;
    }
}
