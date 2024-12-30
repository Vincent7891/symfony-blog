<?php

namespace App\Application\CreatePost;
use App\Domain\Entity\Post;
use App\Domain\Model\PostContent;
use App\Domain\Model\PostTitle;

class CreatePostHandler
{
    public function __construct(
        private readonly CreatePostInterface $createPost,
    )
    {
    }

    public function handle(CreatePostCommand $command) : void
    {
        $post = new Post(
            new PostTitle($command->title),
            new PostContent($command->content),
        );

        $this->createPost->create($post);
    }
}
