<?php

namespace App\Tests;

use App\Domain\Entity\Post;
use App\Domain\Exception\InvalidPostException;
use App\Domain\Model\PostContent;
use App\Domain\Model\PostTitle;
use App\Infrastructure\Database\DatabaseConnection;
use App\Infrastructure\Query\CreatePostQuery\CreatePostQuery;
use PHPUnit\Framework\TestCase;
use PDO;

class SqlPostQueryTest extends TestCase
{

    private readonly PDO $pdo;
    private CreatePostQuery $query;
    protected function setUp(): void {

        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $dbName = $_ENV['DB_NAME'];

        $databaseConnection = new DatabaseConnection($host, $port, $dbName, $user, $password);
        $this->pdo = $databaseConnection->getPDO();

        $this->query = new CreatePostQuery($databaseConnection);
        $this->pdo->exec('DELETE FROM blog_test.POSTS');
    }

    public function testItCreatesPost() : void
    {
        $post = new Post(
            new PostTitle('integration test post'),
            new PostContent('integration test post content')
        );
        $this->query->create($post);
        $getPostsQuery = $this->pdo->prepare(" SELECT * FROM POSTS where id = :id ");
        $getPostsQuery->execute(['id' => $post->getId()]);
        $result = $getPostsQuery->fetch();
        $this->assertEquals('integration test post', $result['title']);
        $this->assertEquals($post->getContent(), $result['content']);
    }

    public function testItThrowsExceptionForShortTitle() : void
    {
        $this->expectException(InvalidPostException::class);
        $this->expectExceptionMessage("Title must be between 1 and 255 characters");
        new PostTitle('');
    }

    public function testItThrowsExceptionForLongTitle() : void
    {
        $this->expectException(InvalidPostException::class);
        $this->expectExceptionMessage("Title must be between 1 and 255 characters");
        $longTitle = str_repeat('a', 256);
        new PostTitle($longTitle);
    }
}
