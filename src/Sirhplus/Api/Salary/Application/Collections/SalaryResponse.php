<?php

namespace Sirhplus\Api\Salary\Application\Collections;

use Sirhplus\Shared\Domain\ResultSet\AbstractCollectionsResponse;

final class SalaryResponse extends AbstractCollectionsResponse
{
    public function __construct(array $data, int $total, int $page, int $size)
    {
        parent::__construct($data, $total, $page, $size);
    }
}
