<?php

namespace Sirhplus\Api\MandatoryBreak\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * class MandatoryBreakResultSet
 */
class MandatoryBreakResultSet extends AbstractResultSet
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
        foreach($this->data as $data) {
            $result[] = $this->list($data);
        }
        
        return $result;
    }

    /**
     * @param object $object
     * @return array
     */
    public function list(object $object): array
    {
        return [
            'uuid' => $object->getId()->toRfc4122(),
            'name' => $object->getName(),
            'workingTimes' => $object->getWorkingTimes(),
            'pause' => $object->getPause(),
        ];
    }
}