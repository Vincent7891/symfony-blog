<?php

namespace App\Application\EditPost;

class EditPostCommand
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $content,
    )
    {}

}
