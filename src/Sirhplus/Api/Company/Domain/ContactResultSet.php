<?php

namespace Sirhplus\Api\Company\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Sirhplus\Shared\Service\RoleManagerInterface;

final class ContactResultSet extends AbstractResultSet
{
    /**
     * @param array $data
     */
    public function __construct(protected array $data)
    {
        parent::__construct($data, 0);
    }

    public function getData(): array
    {
        $result = [];
        foreach ($this->data as $data) {
            $contact = $this->fromEntityToResponse($data);

            if ($contact) {
                $result[] = $contact;
            }
        }

        return $result;
    }

    private function fromEntityToResponse(object $object): ?array
    {
        if (in_array(RoleManagerInterface::ROLE_OWNER, $object->getRoles()) ||
            in_array(RoleManagerInterface::ROLE_ADMIN, $object->getRoles())) {
            $function = ($value = $object->getSalary()->getFunctions()) ? $value->getName() : '';

            return [
                'id' => $object->getId()->toRfc4122(),
                'firstName' => $object->getFirstName(),
                'lastName' => $object->getLastName(),
                'function' => $function,
                'email' => $object->getEmail(),
                'phoneNumber' => $object->getPhoneNumber() ?? '',
            ];
        }
        return null;
    }
}
