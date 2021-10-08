<?php

namespace App\Http\Actions\Auth\Delete;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Packages\Services\TokenManagerServiceInterface;

final class DeleteAction
{
    public function __construct(
        private TokenManagerServiceInterface $tokenManagerService,
        private DeleteResponder $responder
    ){
    }

    public function __invoke(DeleteRequest $request) : Response
    {
        $token = $request->header('Authorization');
        $tokenDto = $this->tokenManagerService->getCredential($token);
        Log::debug('expired token', $tokenDto->toArray());

        $this->tokenManagerService->expired($tokenDto);

        return $this->responder->respond($tokenDto);
    }
}
