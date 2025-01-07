<?php

declare(strict_types=1);

namespace App\Application\DeletePost;

class DeletePostHandler
{
    public function __construct(private readonly DeletePostInterface $deletePost)
    {
    }

    public function handle(DeletePostCommand $command): void
    {
        $this->deletePost->delete($command->id);
    }
}
