<?php

namespace Sirhplus\Api\HourlyRegime\Application\AddHourlyRegime;

use Sirhplus\Shared\Service\Response;

/**
 * class AddHourlyRegimeResponse
 */
final class AddHourlyRegimeResponse implements Response
{
    public function __construct(private readonly object $object)
    {
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return [
            'id' => $this->object->getId()->toRfc4122(),
        ];
    }
}