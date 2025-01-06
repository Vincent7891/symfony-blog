<?php

declare(strict_types=1);
namespace App\Infrastructure\Validator;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

Abstract class BaseRequestValidator
{
    abstract protected function getRequiredFields(): array;

    public function validate(Request $request): JsonResponse|array
    {
        $data = \json_decode($request->getContent(), true);
        if (!\is_array($data)) {
            return new JsonResponse(['error' => 'invalid json'], Response::HTTP_BAD_REQUEST);
        }

        $missingFields = array_diff($this->getRequiredFields(), array_keys($data));
        if (!empty($missingFields)) {
            return new JsonResponse(['error' => 'missing required fields: ' .implode(',', $missingFields)], Response::HTTP_BAD_REQUEST);
        }

        return $data;
    }


}
