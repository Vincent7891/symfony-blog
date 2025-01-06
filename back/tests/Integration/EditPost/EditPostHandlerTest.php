<?php

namespace App\Tests\Integration\EditPost;

use App\Application\EditPost\EditPostCommand;
use App\Application\EditPost\EditPostHandler;
use App\Infrastructure\Query\EditPostQuery\EditPostQuery;
use App\Tests\Integration\DatabaseTestCase;
use InvalidArgumentException;


class EditPostHandlerTest extends DatabaseTestCase
{
    private EditPostHandler $handler;

    protected function setUp():void
    {
        parent::setUp();
        $editPostsQuery = new EditPostQuery($this->databaseConnection);
        $this->handler = new EditPostHandler($editPostsQuery);
    }

    public function testItEditsPost():void {
        $this->insertPost(1, 'title of post 1', 'content of post 1');
        $this->insertPost(2, 'title of post 2', 'content of post 2');
        $editPostCommand = new EditPostCommand(1,'edited title of post 1', 'edited content of post 1');
        $this->handler->handle($editPostCommand);
        $editedPost = $this->getPostById(1);
        $this->assertEquals($editPostCommand->title,$editedPost['title'] );
        $this->assertEquals($editPostCommand->content,$editedPost['content'] );
    }

}
