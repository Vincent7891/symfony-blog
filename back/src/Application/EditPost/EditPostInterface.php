<?php

declare(strict_types=1);
namespace App\Application\EditPost;

use App\Domain\Model\PostContent;
use App\Domain\Model\PostTitle;

interface EditPostInterface
{
    public function edit(int $id, PostTitle $title, PostContent $content): void;
}
