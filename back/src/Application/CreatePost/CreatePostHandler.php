<?php

namespace App\Application\CreatePost;
use App\Domain\Entity\Post;
use App\Domain\Exception\InvalidPostException;
use App\Domain\Model\PostContent;
use App\Domain\Model\PostTitle;
use Symfony\Component\HttpFoundation\Response;

class CreatePostHandler
{
    public function __construct(
        private readonly CreatePostInterface $createPost,
    )
    {
    }

    public function handle(CreatePostCommand $command) : void
    {
        try{
            $post = new Post(
                new PostTitle($command->title),
                new PostContent($command->content),
            );
            $this->createPost->create($post);
        } catch (InvalidPostException $exception){
            throw new \InvalidArgumentException($exception->getMessage(), Response::HTTP_BAD_REQUEST, $exception);
        }
    }
}
