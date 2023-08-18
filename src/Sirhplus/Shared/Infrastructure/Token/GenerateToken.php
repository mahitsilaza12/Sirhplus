<?php

namespace Sirhplus\Shared\Infrastructure\Token;

use Sirhplus\Shared\Domain\Token\GenerateTokenInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;

final class GenerateToken implements GenerateTokenInterface
{
    public function __construct(private readonly JWTEncoderInterface $encoder)
    {
    }

    public function encode(array $payloads): string
    {
        return $this->encoder->encode($payloads);
    }

    /**
     * @throws JWTDecodeFailureException
     */
    public function decode(string $token): array
    {
        return $this->encoder->decode($token);
    }
}
