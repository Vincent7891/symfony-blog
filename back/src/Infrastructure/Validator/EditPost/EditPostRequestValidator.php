<?php

declare(strict_types=1);
namespace App\Infrastructure\Validator\EditPost;

use App\Infrastructure\Validator\BaseRequestValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPostRequestValidator extends BaseRequestValidator
{
    protected function getRequiredFields(): array
    {
        return ['id', 'title', 'content'];
    }
}
