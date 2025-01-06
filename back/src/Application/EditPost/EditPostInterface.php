<?php

namespace App\Application\EditPost;

use App\Domain\Model\PostContent;
use App\Domain\Model\PostTitle;

interface EditPostInterface
{
    public function edit(int $id, postTitle $title, postContent $content) : void;
}
