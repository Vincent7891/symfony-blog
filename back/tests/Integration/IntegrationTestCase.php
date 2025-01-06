<?php

namespace App\Tests\Integration;

use App\Infrastructure\Database\DatabaseConnection;
use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    protected readonly \PDO $pdo;
    protected readonly DatabaseConnection $databaseConnection;

    protected function setUp(): void
    {
        parent::setUp();
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $dbName = $_ENV['DB_NAME'];

        $this->databaseConnection = new DatabaseConnection($host, $port, $dbName, $user, $password);

        $this->pdo = $this->databaseConnection->getPDO();
        $this->pdo->beginTransaction();
    }

    protected function tearDown(): void
    {
        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }
        parent::tearDown();
    }
}
