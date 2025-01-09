<?php

declare(strict_types=1);

namespace App\Infrastructure\Query\GetPostQueries;

use App\Application\GetPosts\GetPostsInterface;
use App\Infrastructure\Database\DatabaseConnection;

class GetPostsQuery implements GetPostsInterface
{
    private readonly \PDO $pdo;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->pdo = $databaseConnection->getPdo();
    }

    public function get(): array
    {
        $query = $this->pdo->prepare('SELECT * FROM POSTS');
        $query->execute();

        return $query->fetchAll();
    }
}
