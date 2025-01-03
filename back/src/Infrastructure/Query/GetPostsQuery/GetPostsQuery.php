<?php

namespace App\Infrastructure\Query\GetPostsQuery;

use App\Application\GetPosts\GetPostsInterface;
use App\Infrastructure\Database\DatabaseConnection;
use PDO;

class GetPostsQuery implements getPostsInterface
{
    private readonly PDO $pdo;
    public function __construct(DatabaseConnection $databaseConnection){
        $this->pdo = $databaseConnection->getPdo();
    }

    public function get(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM POSTS");
        $query->execute();
        return $query->fetchAll();
    }
}
