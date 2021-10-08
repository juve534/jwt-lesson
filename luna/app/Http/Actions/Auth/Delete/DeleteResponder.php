<?php

declare(strict_types=1);

namespace App\Http\Actions\Auth\Delete;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Packages\Services\TokenDto;

final class DeleteResponder
{
    public function __construct(private ResponseFactory $responseFactory)
    {
    }

    public function respond(TokenDto $token): Response
    {
        return $this->responseFactory->noContent();
    }
}
