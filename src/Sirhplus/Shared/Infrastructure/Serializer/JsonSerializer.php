<?php

namespace Sirhplus\Shared\Infrastructure\Serializer;

use Sirhplus\Shared\Service\json;
use Sirhplus\Shared\Service\JsonSerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * class JsonSerializer
 */
final class JsonSerializer implements JsonSerializerInterface
{
    /**
     * @param object $object
     * @return string
     */
    public function serialize(object $object): string
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);

        return $serializer->serialize($object, 'json');
    }
}
