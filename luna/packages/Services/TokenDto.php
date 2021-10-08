<?php

declare(strict_types=1);

namespace Packages\Services;

class TokenDto
{
    public function __construct(private string $token)
    {
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
