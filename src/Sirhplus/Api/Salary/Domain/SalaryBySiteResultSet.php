<?php

namespace Sirhplus\Api\Salary\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

final class SalaryBySiteResultSet extends AbstractResultSet
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
        $user = $object->getUser()->toArray()[0];

        return [
            'uuid' => $object->getId()->toRfc4122(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
        ];
    }
}
