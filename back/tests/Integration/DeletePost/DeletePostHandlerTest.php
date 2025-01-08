<?php

namespace App\Tests\Integration\DeletePost;

use App\Application\DeletePost\DeletePostCommand;
use App\Application\DeletePost\DeletePostHandler;
use App\Infrastructure\Query\DeletePostQuery\DeletePostQuery;
use App\Tests\Integration\DatabaseTestCase;

class DeletePostHandlerTest extends DatabaseTestCase
{
    private DeletePostHandler $handler;

    protected function setUp(): void
    {
        parent::setup();
        $deletePostQuery = new DeletePostQuery($this->databaseConnection);
        $this->handler = new DeletePostHandler($deletePostQuery);
    }

    public function testItDeletesPost(): void
    {
        $this->insertPost(1, 'title of post', 'content of the post');
        $deletePostCommand = new DeletePostCommand(1);
        $this->handler->handle($deletePostCommand);
        $this->assertTrue($this->assertPostDoesNotExist(1));
    }

    public function assertPostDoesNotExist(int $id): bool | array
    {
        $post = $this->getPostById(1);
        if($post === false){
            return true;
        }
        return false;
    }
}
