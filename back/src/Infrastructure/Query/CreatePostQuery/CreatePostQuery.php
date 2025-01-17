<?php

declare(strict_types=1);

namespace App\Infrastructure\Query\CreatePostQuery;

use App\Application\CreatePost\CreatePostInterface;
use App\Domain\Entity\Post;
use App\Infrastructure\Database\DatabaseConnection;

class CreatePostQuery implements CreatePostInterface
{
    private \PDO $pdo;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->pdo = $databaseConnection->getPdo();
    }

    public function create(Post $post): void
    {
        $query = $this->pdo->prepare('INSERT INTO POSTS (
                   title, content) VALUES (:title, :content)');

        $query->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
        ]);
        $post->setId((int) $this->pdo->lastInsertId());
    }
}
