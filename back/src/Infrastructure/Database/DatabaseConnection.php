<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

class DatabaseConnection
{
    private \PDO $pdo;

    public function __construct(string $host, string $port, string $dbName,
        string $user, string $password)
    {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbName";

        try {
            $this->pdo = new \PDO($dsn, $user, $password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}
