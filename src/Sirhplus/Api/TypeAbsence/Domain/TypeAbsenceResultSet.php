<?php

namespace Sirhplus\Api\TypeAbsence\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

class TypeAbsenceResultSet extends AbstractResultSet
{

    public function __construct(array $data, int $total)
    {
        parent::__construct($data, $total);
    }

    public function getData(): array
    {
        $result = [];
        foreach ($this->data as $data) {
            $result[] = $this->fromEntityToResponse($data);
        }

        return $result;
    }

     /**
     * @param object $object
     * @return array
     */
    private function fromEntityToResponse(object $object): array
    {
        return [
            'uuid' => $object->getId()->toRfc4122(),
            'type' => $object->getType(),
            'color' => $object->getColor(),
            'visibility' => $object->isVisibility()
        ];
    }
}