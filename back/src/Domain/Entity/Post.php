<?php

namespace App\Domain\Entity;
use App\Domain\Model\PostContent;
use App\Domain\Model\PostTitle;
class Post
{
    public function __construct(
        private readonly PostTitle     $title,
        private readonly PostContent   $content,
        private ?int $id = null,
    )
    {}

    public function getId(): ?int {
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
