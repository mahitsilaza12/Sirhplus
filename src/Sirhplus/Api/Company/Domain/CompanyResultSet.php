<?php

namespace Sirhplus\Api\Company\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * class CompanyResultSet
 */
final class CompanyResultSet extends AbstractResultSet
{
    /**
     * @param array $data
     * @param int $total
     */
    public function __construct(protected array $data, protected int $total)
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
        $subscription = $object->getSubscription();

        return [
            'uuid' => $object->getId()->toRfc4122(),
            'information' => [
                'name' => $object->getName(),
                'logo' => $object->getLogo() ?? '',
            ],
            'effective' => $object->getUsers()->count(), // TODO à modifier
            'subscription' => [
                'uuid' => $subscription ? $subscription->getId()->toRfc4122() : null,
                'type' => $subscription ? $subscription->getType() : null,
                'isPay' => $subscription ? $subscription->isFree() : null,
                'expiresIn' => $subscription ? $subscription->getExpiredIn() : null,
            ],
            'contact' => [
                'email' => $object->getProperty() ? $object->getProperty()->getEmail() : '',
                'phone' => $object->getProperty() ? $object->getPhoneNumber() : '',
            ],
        ];
    }
}
