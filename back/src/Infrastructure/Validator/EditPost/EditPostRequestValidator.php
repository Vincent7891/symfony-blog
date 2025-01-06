<?php

declare(strict_types=1);

namespace App\Infrastructure\Validator\EditPost;

use App\Infrastructure\Validator\BaseRequestValidator;

class EditPostRequestValidator extends BaseRequestValidator
{
    protected function getRequiredFields(): array
    {
        return ['id', 'title', 'content'];
    }
}
