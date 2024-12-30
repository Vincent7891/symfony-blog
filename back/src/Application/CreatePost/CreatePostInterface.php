<?php

//declare(strict_types=1);

namespace App\Application\CreatePost;
use App\Domain\Entity\Post;

interface CreatePostInterface
{
    public function create(Post $post): void;
}
