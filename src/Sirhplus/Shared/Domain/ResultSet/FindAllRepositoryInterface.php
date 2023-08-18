<?php

namespace Sirhplus\Shared\Domain\ResultSet;

use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;

interface FindAllRepositoryInterface
{
    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet;
}