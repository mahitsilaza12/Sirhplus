<?php

namespace Sirhplus\Api\Company\Application\GetTeams;

use Sirhplus\Shared\Domain\ResultSet\AbstractCollectionsResponse;

/**
 * class CompanyTeamResponse
 */
final class CompanyTeamResponse extends AbstractCollectionsResponse
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
        $this->mapping();
    }

    /**
     * @return void
     */
    private function mapping(): void
    {
        $this->data = array_map(function ($value) {
            return [
                'id' => $value->getId()->toRfc4122(),
                'name' => $value->getName(),
                'salary' => 0,
            ];
        }, $this->data);
    }
}
