<?php

namespace Sirhplus\Api\Company\Application\GetUsersSalary;

use Sirhplus\Shared\Domain\ResultSet\AbstractCollectionsResponse;

/**
 * class UserResponse
 */
final class UserResponse extends AbstractCollectionsResponse
{
    /**
     * @param array $data
     * @param int $total
     * @param int $page
     * @param int $size
     */
    public function __construct(array $data, int $total, int $page, int $size)
    {
        parent::__construct($data, $total, $page, $size);
    }
}
