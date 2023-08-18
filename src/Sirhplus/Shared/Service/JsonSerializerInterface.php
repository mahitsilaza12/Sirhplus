<?php

namespace Sirhplus\Shared\Service;

/**
 * interface JsonSerializerInterface
 */
interface JsonSerializerInterface
{
    /**
     * @param object $object
     * @return string
     */
    public function serialize(object $object): string;
}
