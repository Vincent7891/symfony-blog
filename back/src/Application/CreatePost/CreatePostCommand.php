<?php
namespace App\Application\CreatePost;
final class CreatePostCommand
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
    ){
    }
}
