<?php

declare(strict_types=1);

namespace App\Http\Actions\Auth\Create;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Packages\Services\TokenDto;

final class CreateResponder
{
    public function __construct(private ResponseFactory $responseFactory)
    {
    }

    public function respond(TokenDto $token): JsonResponse
    {
        return $this->responseFactory->json([
            'token' => $token->getToken(),
        ]);
    }
}
