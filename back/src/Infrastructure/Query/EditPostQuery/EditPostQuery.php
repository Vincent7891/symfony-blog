<?php

declare(strict_types=1);

namespace App\Infrastructure\Query\EditPostQuery;

use App\Application\EditPost\EditPostInterface;
use App\Domain\ValueObject\PostContent;
use App\Domain\ValueObject\PostTitle;
use App\Infrastructure\Database\DatabaseConnection;

class EditPostQuery implements EditPostInterface
{
    private \PDO $pdo;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->pdo = $databaseConnection->getPdo();
    }

    public function edit(int $id, PostTitle $title, PostContent $content): void
    {
        $query = $this->pdo->prepare(
            'UPDATE POSTS SET title = :title, content = :content WHERE id = :id',
        );
        $query->execute([
            'id' => $id,
            'title' => $title->getTitle(),
            'content' => $content->getPost(),
        ]);
    }
}
