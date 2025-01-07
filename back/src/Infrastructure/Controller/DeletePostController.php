<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\DeletePost\DeletePostCommand;
use App\Application\DeletePost\DeletePostHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeletePostController extends AbstractController
{
    public function __construct(
        private readonly DeletePostHandler $handler,
    ) {
    }

    public function deletePost(Request $request): JsonResponse
    {
        $data = \json_decode($request->getContent(), true);
        $command = new DeletePostCommand($data['id']);
        try {
            $this->handler->handle($command);

            return new JsonResponse(['message' => 'post deleted successfully'], Response::HTTP_NO_CONTENT);
        } catch (\Exception) {
            return new JsonResponse(['error' => 'An unexpected error has occurred'], Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }
}
