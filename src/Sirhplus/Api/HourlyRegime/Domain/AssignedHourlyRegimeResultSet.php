<?php

namespace Sirhplus\Api\HourlyRegime\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

class AssignedHourlyRegimeResultSet extends AbstractResultSet
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
        $users = $object->getCompany()->getUsers();
        $result['id'] = $object->getId();
        $result['name'] = $object->getName();
        $result['salary'] = 0;
        foreach ($users as $user) {
            $salary = $user->getSalary();
            if ($salary->getHourlyRegime() && $object->getId() === $salary->getHourlyRegime()->getId()) {
                $result['salary'] += 1;
            }
        }

        return $result;
    }
}