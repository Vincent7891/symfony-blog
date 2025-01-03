<?php

namespace App\Application\GetPosts;

class GetPostsHandler
{
    public function __construct(private readonly GetPostsInterface $getPosts)
    {
    }

    public function handle() : array
    {
        return $this->getPosts->get();
    }

}
