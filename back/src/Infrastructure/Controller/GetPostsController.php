<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\GetPosts\GetPostsHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetPostsController extends AbstractController
{
    public function __construct(private readonly GetPostsHandler $handler)
    {
    }

    public function getPosts(): JsonResponse
    {
        try {
            $posts = $this->handler->handle();

            return new JsonResponse($posts, Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
