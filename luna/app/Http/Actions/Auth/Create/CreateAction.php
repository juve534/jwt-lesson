<?php

namespace App\Http\Actions\Auth\Create;

use Illuminate\Http\JsonResponse;
use Packages\Services\TokenManagerServiceInterface;

final class CreateAction
{
    public function __construct(
        private TokenManagerServiceInterface $tokenManagerService,
        private CreateResponder $responder
    ){
    }

    public function __invoke(CreateRequest $request) : JsonResponse
    {
        // なんらかの認証処理
        //

        $accessKey = uniqid();
        $token = $this->tokenManagerService->issue($accessKey);

        return $this->responder->respond($token);
    }
}
