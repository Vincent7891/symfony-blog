<?php

declare(strict_types=1);

namespace App\Application\GetPosts;

interface GetPostsInterface
{
    public function get(): array;
}
