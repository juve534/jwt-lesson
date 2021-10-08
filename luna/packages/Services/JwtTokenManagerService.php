<?php

declare(strict_types=1);

namespace Packages\Services;

use Carbon\CarbonImmutable;
use Lcobucci\JWT\Configuration;

class JwtTokenManagerService implements TokenManagerServiceInterface
{
    public function __construct(
        private Configuration $config
    ){
    }

    /**
     * {@inheritDoc}
     */
    public function issue(string $accessKey) : TokenDto
    {
        assert($this->config instanceof Configuration);

        $now = new CarbonImmutable();
        $token = $this->config->builder()
            ->issuedBy(config('app.url'))
            ->identifiedBy(uniqid(), true)
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now->addMinute(30))
            ->expiresAt($now->addMinute(30))
            ->withClaim('accessKey', $accessKey)
            ->getToken($this->config->signer(), $this->config->signingKey());

        return new TokenDto(token: $token->toString());
    }
}
