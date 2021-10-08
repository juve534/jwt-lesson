<?php

declare(strict_types=1);

namespace Packages\Services;

class TokenDto
{
    public function __construct(
        private string $token,
        private string $accessKey
    ){
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    public function toArray(): array
    {
        return [
            'accessKey' => $this->getAccessKey(),
            'token' => $this->getToken(),
        ];
    }
}
