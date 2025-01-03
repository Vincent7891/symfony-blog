<?php

namespace App\Tests\Integration\CreatePost;

use App\Application\GetPosts\GetPostsHandler;
use App\Infrastructure\Query\GetPostsQuery\GetPostsQuery;
use App\Tests\Integration\DatabaseTestCase;

class GetPostsHandlerTest extends DatabaseTestCase
{
    private getPostsHandler $handler;

    protected function setUp():void
    {
        parent::setUp();
        $getPostsQuery = new GetPostsQuery($this->databaseConnection);
        $this->handler = new GetPostsHandler($getPostsQuery);
    }

    public function testsItSuccessfullyGetsPosts(): void
    {
        $postsWhenDbEmpty = $this->handler->handle();
        $this->assertSame(0, count($postsWhenDbEmpty));

        $this->insertPost('title of post 1', 'content of post 1');
        $this->insertPost('title of post 2', 'content of post 2');

        $postsWhenDbPopulated = $this->handler->handle();
        $this->assertSame(2, count($postsWhenDbPopulated));
    }
}
