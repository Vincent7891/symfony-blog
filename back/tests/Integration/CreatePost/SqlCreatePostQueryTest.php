<?php

namespace App\Tests\Integration\CreatePost;

use App\Application\CreatePost\CreatePostInterface;
use App\Domain\Entity\Post;
use App\Domain\Exception\InvalidPostException;
use App\Domain\Model\PostContent;
use App\Domain\Model\PostTitle;
use App\Infrastructure\Query\CreatePostQuery\CreatePostQuery;
use App\Tests\Integration\IntegrationTestCase;


class SqlCreatePostQueryTest extends IntegrationTestCase
{
    private CreatePostInterface $query;
    protected function setUp(): void
    {
        parent::setUp();
        $this->query = new CreatePostQuery($this->databaseConnection);
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
}
