<?php

namespace Sirhplus\Api\User\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * class UserResultSet
 */
final class UserResultSet extends AbstractResultSet
{
    /**
     * @param array $data
     * @param int $total
     */
    public function __construct(array $data = [], int $total = 0)
    {
        parent::__construct($data, $total);
    }

    /**
     * @return array
     */
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
            'id' => $object->getId(),
            'firstName' => $object->getFirstName(),
            'lastName' => $object->getLastName(),
            'logo' => 'string', // TODO : a modifier
            'responsibility' => $object->getResponsibility(),
            'email' => $object->getEmail(),
            'role' => $object->getRoles(),
        ];
    }
}
