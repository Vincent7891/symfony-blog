<?php

namespace App\Tests\Integration\CreatePost;

use App\Application\CreatePost\CreatePostCommand;
use App\Application\CreatePost\CreatePostHandler;
use App\Domain\Exception\InvalidPostException;
use App\Infrastructure\Query\CreatePostQuery\CreatePostQuery;
use App\Tests\Integration\IntegrationTestCase;

class CreatePostHandlerTest extends IntegrationTestCase
{
    private CreatePostHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $createPostQuery = new CreatePostQuery($this->databaseConnection);
        $this->handler = new CreatePostHandler($createPostQuery);
    }

    public function testItHandlesValidPost(): void
    {
        $command = new CreatePostCommand(
            'valid title',
            'valid content for post'
        );
        $this->handler->handle($command);
        $getPostsQuery = $this->pdo->prepare(" SELECT * FROM POSTS where title = :title ");
        $getPostsQuery->execute(['title' => $command->title]);
        $result = $getPostsQuery->fetch();

        $this->assertEquals($command->title, $result['title']);
        $this->assertEquals($command->content, $result['content']);
    }

    public function testItThrowsExceptionForShortTitle(): void
    {
        $this->expectException(InvalidPostException::class);
        $this->expectExceptionMessage("Title must be between 1 and 255 characters");

        $command = new CreatePostCommand('', 'normal content');
        $this->handler->handle($command);
    }

    public function testItThrowsExceptionForLongTitle(): void
    {
        $this->expectException(InvalidPostException::class);
        $this->expectExceptionMessage("Content cannot be empty");

        $command = new CreatePostCommand(
            'valid title', '');
        $this->handler->handle($command);
    }
}
