<?php

namespace App\Infrastructure\Query\GetPostQueries;

use App\Application\GetPosts\GetPostByIdInterface;
use App\Domain\Entity\Post;
use App\Domain\Exception\PostNotFoundException;
use App\Domain\ValueObject\PostContent;
use App\Domain\ValueObject\PostTitle;
use App\Infrastructure\Database\DatabaseConnection;

class GetPostByIdQuery implements GetPostByIdInterface
{
    private \PDO $pdo;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->pdo = $databaseConnection->getPdo();
    }

    public function get(int $id): Post
    {
        $query = $this->pdo->prepare('SELECT * FROM POSTS WHERE id = :id');
        $query->execute(['id' => $id]);
        $post = $query->fetch();
        if (!$post) {
            throw new PostNotFoundException('the post with id '.$id.' was not found');
        }

        return new Post(
            new PostTitle($post['title']),
            new PostContent($post['content']),
            $post['id'],
        );
    }
}
