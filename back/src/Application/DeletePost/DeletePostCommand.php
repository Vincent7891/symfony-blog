<?php

declare(strict_types=1);

namespace App\Application\DeletePost;

final class DeletePostCommand
{
    public function __construct(public readonly int $id)
    {
    }
}
