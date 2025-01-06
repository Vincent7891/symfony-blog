<?php

namespace App\Tests\Integration\GetPosts;

use App\Application\GetPosts\GetPostsHandler;
use App\Infrastructure\Query\GetPostsQuery\GetPostsQuery;
use App\Tests\Integration\DatabaseTestCase;

class GetPostsHandlerTest extends DatabaseTestCase
{
    private GetPostsHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $getPostsQuery = new GetPostsQuery($this->databaseConnection);
        $this->handler = new GetPostsHandler($getPostsQuery);
    }

    public function testsItSuccessfullyGetsPosts(): void
    {
        $postsWhenDbEmpty = $this->handler->handle();
        $this->assertSame(0, \count($postsWhenDbEmpty));

        $this->insertPost(1, 'title of post 1', 'content of post 1');
        $this->insertPost(2, 'title of post 2', 'content of post 2');

        $postsWhenDbPopulated = $this->handler->handle();
        $this->assertSame(2, \count($postsWhenDbPopulated));
        $this->assertSame('title of post 1', $postsWhenDbPopulated[0]->getTitle());
        $this->assertSame('content of post 1', $postsWhenDbPopulated[0]->getContent());

        $this->assertSame('title of post 2', $postsWhenDbPopulated[1]->getTitle());
        $this->assertSame('content of post 2', $postsWhenDbPopulated[1]->getContent());
    }
}
