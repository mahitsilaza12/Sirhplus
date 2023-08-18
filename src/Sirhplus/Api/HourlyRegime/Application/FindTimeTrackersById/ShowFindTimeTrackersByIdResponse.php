<?php

namespace Sirhplus\Api\HourlyRegime\Application\FindTimeTrackersById;

use Sirhplus\Shared\Service\Response;

/**
 * class ShowFindTimeTrackersByIdResponse
 */
final class ShowFindTimeTrackersByIdResponse implements Response
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
                'limite' => $this->object->isLimite(),
                'limiteDay' => $this->object->getLimitDay(),
                'calculation' => $this->object->isCalculation(),
                'dayCalculation' => $this->object->getDayCalculation(),
        ];
    }
}

