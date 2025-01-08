<?php

declare(strict_types=1);

namespace App\Application\DeletePost;

use App\Application\GetPosts\GetPostByIdInterface;

class DeletePostHandler
{
    public function __construct(
        private readonly DeletePostInterface $deletePost,
        private readonly GetPostByIdInterface $getPostByIdQuery,
    ) {
    }

    public function handle(DeletePostCommand $command): void
    {
        if (0 == $command->id) {
            throw new \InvalidArgumentException('Id is required');
        }
        $this->checkPostExists($command->id);
        $this->deletePost->delete($command->id);
    }

    private function checkPostExists(int $id): void
    {
        $this->getPostByIdQuery->get($id);
    }
}
