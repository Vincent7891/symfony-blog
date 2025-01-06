<?php

declare(strict_types=1);
namespace App\Infrastructure\Validator\CreatePost;

use App\Infrastructure\Validator\BaseRequestValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreatePostRequestValidator extends BaseRequestValidator
{
    protected function getRequiredFields(): array
    {
        return ['title', 'content'];
    }
}
