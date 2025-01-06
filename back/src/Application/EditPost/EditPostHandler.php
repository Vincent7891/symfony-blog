<?php

namespace App\Application\EditPost;

use App\Domain\Exception\InvalidPostException;
use App\Domain\Model\PostContent;
use App\Domain\Model\PostTitle;
use Symfony\Component\HttpFoundation\Response;

class EditPostHandler
{
    public function __construct(
        private readonly EditPostInterface $editPost,
    ) {
    }

    public function handle(EditPostCommand $command): void
    {
        try {
            $title = new PostTitle($command->title);
            $content = new PostContent($command->content);
            $this->editPost->edit($command->id, $title, $content);
        } catch (InvalidPostException $exception) {
            throw new \InvalidArgumentException($exception->getMessage(), Response::HTTP_BAD_REQUEST, $exception);
        }
    }
}
