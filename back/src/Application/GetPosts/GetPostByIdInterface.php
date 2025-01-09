<?php

namespace App\Application\GetPosts;

interface GetPostByIdInterface
{
    public function get(int $id): array;
}
