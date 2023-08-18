<?php

namespace Sirhplus\Api\DaylyConfig\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * class DayConfigResultSet
 */
final class DayConfigResultSet extends AbstractResultSet
{

    /**
     * @param array $data
     * @param integer $total
     */
    public function __construct(array $data, int $total)
    {
        parent::__construct($data, $total);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $result = [];
        foreach ($this->data as $data){
            $result[] = $this->list($data);
        }

        return $result;
    }

    /**
     * @param object $object
     * @return array
     */
    private function list(object $object): array
    {
        $day = [
            'uuid' => $object->getId(),
            'type' => $object->getType(),
            'day' => $object->getDay(),
            'startTime' => $object->getStartTime(),
            'endTIme' => $object->getEndTIme(),
            'startBreakTime' => $object->getStartBreakTime(),
            'endBreakTime' => $object->getEndBreakTime(),
            'agreedWorkingHours' => $object->getAgreedWorkingHours(),
            'status' => $object->isStatus(),
            'hourlyRegimeUuid' => $object->getHourlyRegime()->getId(),
        ];
        return $day;
    }
}