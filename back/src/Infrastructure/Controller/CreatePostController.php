<?php

namespace App\Infrastructure\Controller;
use App\Application\CreatePost\CreatePostCommand;
use App\Application\CreatePost\CreatePostHandler;
use App\Infrastructure\Validator\CreatePost\CreatePostRequestValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreatePostController extends AbstractController
{

    public function __construct(
        private readonly CreatePostHandler $handler,
        private readonly CreatePostRequestValidator $validator
    ){}

    public function create(Request $request):JsonResponse
    {

        $data = $this->validator->validate($request);
        if($data instanceof JsonResponse){
            return $data;
        }
        $command = new CreatePostCommand(
            $data['title'],
            $data['content']
        );
        try {
            $this->handler->handle($command);
            return new JsonResponse(
                ['message' => 'Post created successfully'], Response::HTTP_CREATED
            );
        } catch (\InvalidArgumentException $exception){
            return new JsonResponse(
                ['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception) {
            return new JsonResponse(
                ['error' => 'An unexpected error has occurred'], Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
