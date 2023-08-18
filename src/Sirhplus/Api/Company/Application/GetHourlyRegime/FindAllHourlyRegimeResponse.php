<?php

namespace Sirhplus\Api\Company\Application\GetHourlyRegime;

use Sirhplus\Shared\Domain\ResultSet\AbstractCollectionsResponse;

final class FindAllHourlyRegimeResponse extends AbstractCollectionsResponse
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
            $users = $value->getCompany()->getUsers();
            $result['id'] = $value->getId()->toRfc4122();
            $result['name'] = $value->getName();
            $result['salary'] = 0;
            foreach ($users as $user) {
                $salary = $user->getSalary();
                $hourly = $salary->getHourlyRegime();
                if ($hourly && $value->getId() === $hourly->getId()) {
                    $result['salary'] += 1;
                }
            }
            return $result;
        }, $this->data);
    }
}