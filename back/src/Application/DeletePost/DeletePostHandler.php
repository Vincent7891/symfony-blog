<?php

declare(strict_types=1);

namespace App\Application\DeletePost;

use App\Application\GetPosts\GetPostByIdInterface;
use App\Domain\Exception\PostNotFoundException;

class DeletePostHandler
{
    public function __construct(
        private readonly DeletePostInterface $deletePost,
        private readonly GetPostByIdInterface $getPostByIdQuery,
    ) {
    }

    /**
     * @throws PostNotFoundException
     */
    public function handle(DeletePostCommand $command): void
    {
        if (0 == $command->id) {
            throw new \InvalidArgumentException('Id is required');
        }

        if (!$this->doesPostExist($command->id)) {
            throw new PostNotFoundException("The post with id {$command->id} does not exist");
        }

        $this->deletePost->delete($command->id);
    }

    private function doesPostExist(int $id): bool
    {
        try {
            $this->getPostByIdQuery->get($id);

            return true;
        } catch (PostNotFoundException $exception) {
            return false;
        }
    }
}
