<?php

namespace Sirhplus\Shared\Domain\Token;

interface GenerateTokenInterface
{
    /**
     * @param array $payloads
     * @return string
     */
    public function encode(array $payloads): string;

    /**
     * @param string $token
     * @return array
     */
    public function decode(string $token): array;
}
