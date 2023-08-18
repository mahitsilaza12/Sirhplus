<?php

namespace Sirhplus\Shared\Domain\Doctrine\Repository;

use Sirhplus\Shared\Domain\ValueObject\Uuid;

interface AssignSalaryRepositoryInterface
{
    /**
     * @param Uuid $uuid
     * @param array $salaries
     * @param string $entityClass
     * @return void
     */
    public function assign(Uuid $uuid, array $salaries, string $entityClass): void;
}
