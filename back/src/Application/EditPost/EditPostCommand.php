<?php

declare(strict_types=1);

namespace App\Application\EditPost;

final class EditPostCommand
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $content,
    ) {
    }
}
