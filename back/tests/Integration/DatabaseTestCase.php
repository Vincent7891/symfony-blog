<?php

namespace App\Tests\Integration;

abstract class DatabaseTestCase extends IntegrationTestCase
{
    protected function getPostByTitle($title): array|false
    {
        $query = $this->pdo->prepare('SELECT * FROM POSTS WHERE title = :title');
        $query->execute(['title' => $title]);

        return $query->fetch();
    }

    protected function getPostById(int $id): array|false
    {
        $query = $this->pdo->prepare('SELECT * FROM POSTS WHERE id = :id');
        $query->execute(['id' => $id]);

        return $query->fetch();
    }

    protected function getAllPosts(): array
    {
        $query = $this->pdo->prepare('SELECT * FROM POSTS');
        $query->execute();

        return $query->fetchAll();
    }

    protected function insertPost(int $id, string $title, string $content): void
    {
        $query = $this->pdo->prepare('INSERT INTO POSTS (id, title, content) VALUES (:id, :title, :content)');
        $query->execute(['id' => $id, 'title' => $title, 'content' => $content]);
    }
}
