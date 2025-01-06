<?php

declare(strict_types=1);

namespace App\Infrastructure\Validator\CreatePost;

use App\Infrastructure\Validator\BaseRequestValidator;

class CreatePostRequestValidator extends BaseRequestValidator
{
    protected function getRequiredFields(): array
    {
        return ['title', 'content'];
    }
}
