<?php

namespace App\Application\GetPosts;

use App\Domain\Entity\Post;

interface GetPostByIdInterface
{
    public function get(int $id): array;
}
