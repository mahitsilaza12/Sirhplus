<?php

namespace Sirhplus\Api\Company\Domain;

use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * class CompanyTeamResultSet
 */
final class CompanyTeamResultSet extends AbstractResultSet
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
        return $this->data;
    }
}
