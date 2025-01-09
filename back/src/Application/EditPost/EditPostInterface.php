<?php

declare(strict_types=1);

namespace App\Application\EditPost;

use App\Domain\ValueObject\PostContent;
use App\Domain\ValueObject\PostTitle;

interface EditPostInterface
{
    public function edit(int $id, PostTitle $title, PostContent $content): void;
}
