<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\DeletePost\DeletePostCommand;
use App\Application\DeletePost\DeletePostHandler;
use App\Domain\Exception\PostNotFoundException;
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
        try {
            $command = new DeletePostCommand($data['id'] ?? 0);
            $this->handler->handle($command);

            return new JsonResponse(['message' => 'post deleted successfully'], Response::HTTP_NO_CONTENT);
        } catch (\InvalidArgumentException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (PostNotFoundException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
