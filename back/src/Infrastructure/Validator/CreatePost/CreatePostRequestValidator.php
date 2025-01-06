<?php

declare(strict_types=1);

namespace App\Infrastructure\Validator\CreatePost;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreatePostRequestValidator
{
    public function validate(Request $request): JsonResponse|array
    {
        $data = \json_decode($request->getContent(), true);
        if (!isset($data['title']) || !isset($data['content'])) {
            return new JsonResponse(['error' => 'Missing required fields'],
                Response::HTTP_BAD_REQUEST);
        }

        return $data;
    }
}
