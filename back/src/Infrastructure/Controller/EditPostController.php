<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\EditPost\EditPostCommand;
use App\Application\EditPost\EditPostHandler;
use App\Infrastructure\Validator\EditPost\EditPostRequestValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPostController extends AbstractController
{
    public function __construct(
        private readonly EditPostHandler $handler,
        private readonly EditPostRequestValidator $validator,
    ) {
    }

    public function editPost(Request $request): JsonResponse
    {
        $data = $this->validator->validate($request);
        if ($data instanceof JsonResponse) {
            return $data;
        }
        $command = new EditPostCommand(
            $data['id'],
            $data['title'],
            $data['content'],
        );

        try {
            $this->handler->handle($command);
            return new JsonResponse(['message' => 'Post edited successfully'], Response::HTTP_OK);
        } catch (\InvalidArgumentException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
