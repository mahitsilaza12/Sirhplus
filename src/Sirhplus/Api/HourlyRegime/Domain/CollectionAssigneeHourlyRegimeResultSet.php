<?php

namespace Sirhplus\Api\HourlyRegime\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

class CollectionAssigneeHourlyRegimeResultSet extends AbstractResultSet
{
    public function __construct(array $data, int $total)
    {
        parent::__construct($data, $total);
    }

    public function getData(): array
    {
        $result = [];
        foreach ($this->data as $data) {
            $result = $this->fromEntityToResponse($data);
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
        $result = [];
        foreach ($users as $user) {
            $salary = $user->getSalary();
            if ($salary->getHourlyRegime() && $object->getId() === $salary->getHourlyRegime()->getId()) {
                $result []= [
                    "uuid"=>$user->getSalary()->getId(),
                    "logo"=>$user->getSalary()->getLogo(),
                    "firstName" => $user->getFirstName(),
                    "lastNAme" => $user->getLastName()
                                    ];
            }
        }

        return $result;
    }
}