<?php

namespace Sirhplus\Api\Company\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

final class CompanyFunctionResultSet extends AbstractResultSet
{
    /**
     * @param array $data
     * @param int $total
     */
    public function __construct(protected array $data, protected int $total)
    {
        parent::__construct($data, $total);
    }

    public function getData(): array
    {
        return array_map(function ($value) {
            return $this->fromEntityToResponse($value);
        }, $this->data);
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
            if ($salary->getFunctions() && $object->getId() === $salary->getFunctions()->getId()) {
                $result['salary'] += 1;
            }
        }

        return $result;
    }
}
