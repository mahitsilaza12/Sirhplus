<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

final class SiteResultSet extends AbstractResultSet
{
    /**
     * @param array $data
     * @param int $total
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
            'name' => $object->getName(),
        ];
    }
}
