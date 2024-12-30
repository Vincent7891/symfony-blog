<?php

namespace App\Infrastructure\Controller;
use App\Application\CreatePost\CreatePostCommand;
use App\Application\CreatePost\CreatePostHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{

    public function __construct(
        private readonly CreatePostHandler $handler
    ){}

    public function create(Request $request) :JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreatePostCommand(
            $data['title'],
            $data['content']
        );
        try {
            $this->handler->handle($command);
            return new JsonResponse(
                ['message' => 'Post created'], 201
            );
        } catch (\Exception $exception) {
            return new JsonResponse(
                ['error' => $exception->getMessage()], 400
            );
        }
    }

}
