<?php

declare(strict_types=1);

namespace Packages\Services;

interface TokenManagerServiceInterface
{
    /**
     * トークン発行を行う.
     *
     * @param string $accessKey
     * @return TokenDto
     */
    public function issue(string $accessKey) : TokenDto;

    /**
     * トークンの中身を取得する.
     *
     * @param string $jwt
     * @return TokenDto
     */
    public function getCredential(string $jwt) : TokenDto;

    /**
     * トークンを失効させる.
     *
     * @param TokenDto $dto
     */
    public function expired(TokenDto $dto) : void;

    /**
     * トークンが有効か確認する.
     *
     * @param string $jwt
     *
     * @return bool
     */
    public function verify(string $jwt) : bool;
}
