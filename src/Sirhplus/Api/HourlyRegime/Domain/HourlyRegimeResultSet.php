<?php

namespace Sirhplus\Api\HourlyRegime\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
/**
 * class HourlyRegimeResultSet
 */
class HourlyRegimeResultSet extends AbstractResultSet
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
        return [
            'uuid' => $object->getId()->toRfc4122(),
            'name' => $object->getName(),
            'accountAdditionalHour' => $object->isAccountAdditionalHour(),
            'frequency' => $object->getFrequency(),
            'limite' => $object->isLimite(),
            'limitDay' => $object->getLimitDay(),
            'calculation' => $object->isCalculation(),
            'dayCalculation' => $object->getDayCalculation(),
        ];
    }
}