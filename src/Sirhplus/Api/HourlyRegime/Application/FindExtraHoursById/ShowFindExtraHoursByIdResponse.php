<?php

namespace Sirhplus\Api\HourlyRegime\Application\FindExtraHoursById;

use Sirhplus\Shared\Service\Response;

/**
 * class ShowFindExtraHoursByIdResponse
 */
final class ShowFindExtraHoursByIdResponse implements Response
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param object $object
     */
    public function __construct(private readonly object $object)
    {
        $this->mapping();
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->data;
    }

    /**
     * @return void
     */
    public function mapping(): void
    {
        $this->data = [
                'accountAdditionalHour' => $this->object->isAccountAdditionalHour(),
                'frequency' => $this->object->getFrequency()
        ];
    }
}