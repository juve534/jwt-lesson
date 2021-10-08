<?php

declare(strict_types=1);

namespace Packages\Services;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;

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

        Cache::put($accessKey, $token->toString(), 30 * 60);

        return new TokenDto(token: $token->toString(), accessKey: $accessKey);
    }

    /**
     * {@inheritDoc}
     */
    public function getCredential(string $jwt): TokenDto
    {
        assert($this->config instanceof Configuration);

        $token = $this->config->parser()->parse($jwt);
        assert($token instanceof UnencryptedToken);
        Log::debug('token', $token->claims()->all());

        return new TokenDto(token: $token->toString(), accessKey: $token->claims()->get('accessKey'));
    }

    /**
     * {@inheritDoc}
     */
    public function expired(TokenDto $dto): void
    {
        Cache::forget($dto->getAccessKey());
    }

    /**
     * {@inheritDoc}
     */
    public function verify(string $jwt) : bool
    {
        $token = $this->getCredential($jwt);

        return !is_null($token->getAccessKey()) && Cache::has($token->getAccessKey());
    }
}
