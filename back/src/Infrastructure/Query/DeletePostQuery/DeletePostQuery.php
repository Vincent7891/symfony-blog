<?php

declare(strict_types=1);

namespace App\Infrastructure\Query\DeletePostQuery;

use App\Application\DeletePost\DeletePostInterface;
use App\Domain\Exception\PostNotFoundException;
use App\Infrastructure\Database\DatabaseConnection;
use http\Exception\InvalidArgumentException;

class DeletePostQuery implements DeletePostInterface
{
    private \PDO $pdo;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->pdo = $databaseConnection->getPdo();
    }

    public function delete(int $id): void
    {
        $query = $this->pdo->prepare('DELETE FROM POSTS WHERE id = :id');
        $query->execute(['id' => $id]);

        if($query->rowCount() === 0) {
            throw new PostNotFoundException('The post with id ' . $id . ' was not found.');
        }
    }
}
