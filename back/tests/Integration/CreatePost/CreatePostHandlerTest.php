<?php

namespace App\Tests\Integration\CreatePost;

use App\Application\CreatePost\CreatePostCommand;
use App\Application\CreatePost\CreatePostHandler;
use App\Infrastructure\Query\CreatePostQuery\CreatePostQuery;
use App\Tests\Integration\DatabaseTestCase;
use InvalidArgumentException;

class CreatePostHandlerTest extends DatabaseTestCase
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
        $result = $this->getPostByTitle($command->title);
        $this->assertEquals($command->title, $result['title']);
        $this->assertEquals($command->content, $result['content']);
    }

    public function testItThrowsExceptionForShortTitle(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Title must be between 1 and 255 characters");
        $command = new CreatePostCommand('', 'normal content');
        $this->handler->handle($command);
    }

    public function testItThrowsExceptionForLongTitle(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Title must be between 1 and 255 characters");
        $longTitle = str_repeat('a', 256);
        $command = new CreatePostCommand($longTitle, 'normal content');
        $this->handler->handle($command);
    }

    public function testItThrowsExceptionEmptyContent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Content cannot be empty");
        $command = new CreatePostCommand(
            'valid title', '');
        $this->handler->handle($command);
    }
}
