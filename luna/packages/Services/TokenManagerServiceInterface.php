<?php

declare(strict_types=1);

namespace Packages\Services;

use Packages\Services\TokenDto;

interface TokenManagerServiceInterface
{
    /**
     * トークン発行を行う.
     *
     * @param string $accessKey
     * @return TokenDto
     */
    public function issue(string $accessKey) : TokenDto;
}
