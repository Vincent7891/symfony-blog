<?php

declare(strict_types=1);

namespace App\Application\GetPosts;

use App\Domain\Entity\Post;
use App\Domain\Exception\InvalidPostException;
use App\Domain\ValueObject\PostContent;
use App\Domain\ValueObject\PostTitle;

class GetPostsHandler
{
    public function __construct(private readonly GetPostsInterface $getPosts)
    {
    }

    /**
     * @return Post[]
     *
     * @throws InvalidPostException
     */
    public function handle(): array
    {
        $postsArray = $this->getPosts->get();
        $posts = [];
        foreach ($postsArray as $post) {
            $posts[] = new Post(
                new PostTitle($post['title']),
                new PostContent($post['content']),
                $post['id'],
            );
        }

        return $posts;
    }
}
