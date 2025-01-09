<?php

declare(strict_types=1);

namespace App\Application\DeletePost;

interface DeletePostInterface
{
    public function delete(int $id): void;
}
