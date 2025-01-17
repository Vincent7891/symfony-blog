<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\PostContent;
use App\Domain\ValueObject\PostTitle;

class Post implements \JsonSerializable
{
    public function __construct(
        private readonly PostTitle $title,
        private readonly PostContent $content,
        private ?int $id = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title->getTitle();
    }

    public function getContent(): string
    {
        return $this->content->getPost();
    }
}
